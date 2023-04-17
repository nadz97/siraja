<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Pegawai;
use App\Models\Instansi;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
         $this->middleware('permission:pegawai-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('pegawais AS pgw')
            ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
            ->join('instansis AS ins', 'pgw.instansi_id', '=', 'ins.id')
            ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
            ->select('usr.name AS usrName', 'ins.nama AS insName' , 'jbt.jabatan', 'pgw.*')
            ->paginate(5);
        // return response()->json($data);
        return view('home.pegawai.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansi = DB::table('instansis')->get();
        // $roles = Role::pluck('name' , 'name')->all();
        $roles = DB::table('roles')->where('name' , '!=', 'Admin')->get();
        $jabatan = DB::table('jabatans')->select('id', 'jabatan')->orderBy('jabatan', 'ASC')->get();
        // return response()->json($instansi);

        return view('home.pegawai.create' , compact('instansi' , 'roles', 'jabatan'));
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());

        $this->validate($request, [
            'instansi_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_ktp' => 'required'
        ]);

        // 1. simpan ke tabel user
        $nama_photo = "";
        $id_user = Str::uuid()->toString();
        $user = DB::table('users')->insert([
            'id' => $id_user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == "" ? "" : bcrypt($request->password)
        ]);

        // simpan ke table "model_has_roles"
        $model = new \App\Models\User;

        $mhr = DB::table('model_has_roles')->insert([
            "role_id" => $request->roles,
            "model_type" => get_class($model),
            "model_id" => $user_id
        ]);

        $permissions = DB::table("role_has_permissions")
                    ->where("role_id" , $request->roles)
                    ->select("permission_id")->get();

        foreach( $permissions as $p ){
            $rhp = DB::table("model_has_permissions")->insert([
                "permissions_id" => $p->permission_id,
                "model_type" => "App\Models\User" ,
                "model_id" => $user_id
            ]);
        }

        // 2. simpan ke tabel pegawai

        if ($request->has('photo')) {

            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $id_pegawai = Str::uuid()->toString();
        $id_jabatan = Str::uuid()->toString();

        $jabatan = DB::table('jabatans')->insert([
            'id' => $id_jabatan,
            'jabatan' => $request->jabatan
        ]);

        $pegawai = DB::table('pegawais')->insert([
            'id' => $id_pegawai,
            'user_id' => $id_user,
            'instansi_id' => $request->instansi_id,
            'nik' => $request->nik,
            'jabatan_id' => $id_jabatan,
            'pangkat' => $request->pangkat,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'photo' => $nama_photo,
            'biodata' => $request->biodata
        ]);

        // return response()->json($user);
        // return response()->json($pegawai);
        return redirect()->route('pegawai.index')
                        ->with('success', 'Data pegawai berhasil di tambahkan');
    }



    /**

     * Display the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function show($id)
    {
        $data = DB::table('pegawais AS pgw')
            ->join('users AS usr' , 'pgw.user_id', '=', 'usr.id')
            ->join('instansis AS ins' , 'pgw.instansi_id', '=', 'ins.id')
            ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
            ->where('pgw.id', $id)
            ->select('usr.name AS usrName','usr.email AS usrEmail' , 'jbt.jabatan', 'pgw.*',
                    'ins.*','ins.nama AS insName', 'ins.alamat AS insAlamat', 'ins.email AS insEmail' )
            ->first();

        // return response()->json($data);

        return view('home.pegawai.show', compact('data'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
        $data = DB::table('pegawais AS pgw')
            ->join('users AS usr' , 'pgw.user_id', '=', 'usr.id')
            ->where('pgw.id', $id)
            ->select('usr.name','usr.email' , 'pgw.*')
            ->first();

        $instansi = DB::table('instansis')->get();

        return view('home.pegawai.edit',compact('data', 'instansi'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)
    {
        // 1. ubah data
        $user_id = DB::table('pegawais')
                    ->where('id', $id)
                    ->value('user_id');

        $user = DB::table('users')
                ->where('id', $user_id)
                ->when($request->filled('password'), function($query, $password) {
                    return $query->update([
                        "password" => bcrypt($password)
                    ]);
                })
                ->update([
                    "name" => $request->name,
                    "email" => $request->email
                ]);

        if ($request->has('photo')) {
            $photo = DB::table( 'pegawais' )->where('id', $id)->value('photo');

            unlink( public_path('images/' .$photo) );

            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        } else {
            $nama_photo = DB::table('pegawais')->where('id', $id)->value("photo");
        }

        // 2. ubah data pegawai
        $data = DB::table('pegawais')->where('id', $id)->update([
            "instansi_id" => $request->instansi_id,
            "nik" => $request->nik,
            "jabatan" => $request->jabatan,
            "pangkat" => $request->pangkat,
            "alamat" => $request->alamat,
            "no_ktp" => $request->no_ktp,
            "photo" => $nama_photo,
            "biodata" => $request->biodata
        ]);

        return redirect()->route('pegawai.index')
                        ->with('success', 'Berhasil ubah data pegawai');


    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {
        $photo = DB::table('pegawais')->where( 'id', $id )->value('photo');
        unlink( public_path('images/' .$photo) );

        // user_id
        $id_user = DB::table('pegawais')->where('id', $id)->value('user_id');

        $del_user = DB::table('users')->where('id', $id_user)->delete();

        $data = DB::table('pegawais')->where('id', $id)->delete();

        // return response()->json($data);

        return redirect()->route('pegawai.index')
            ->with('success', 'Berhasil hapus data pegawai');
    }

}
