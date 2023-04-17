<?php

namespace App\Http\Controllers;

use App\Models\Instansi;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInstansiRequest;
use App\Http\Requests\UpdateInstansiRequest;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('instansis')->paginate(5);
        // return response()->json($data);
        return view('home.instansi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('instansis');
        return view('home.instansi.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstansiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $nama_logo = "";
        $id = Str::uuid()->toString();
        // return response()->json($id);

        if ($request->has('logo')) {

            $nama_logo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('logo')->getClientOriginalName();
            echo $nama_logo;
            $request->logo->move(public_path('images'), $nama_logo);

            // Simpan ke tabel "instansi"

            $simpan = DB::table('instansis')->insert([
                "id" => $id,
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "logo" => $nama_logo == "" ? "" : $nama_logo,
                "telp" => $request->telp,
                "email" => $request->email,
                "keterangan" => $request->keterangan
            ]);

            return redirect()->route('instansi.index')
                ->with('success', 'Data instansi berhasil di tambah');


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = DB::table('instansis')->where( 'id', $id)->first();
        // return response()->json($data);

        return view('home.instansi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstansiRequest  $request
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->has('logo')) {
            $logo = DB::table( 'instansi' )->where('id', $id)->value('logo');

            unlink( public_path('images/' .$logo) );

            $nama_logo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('logo')->getClientOriginalName();

            $request->logo->move(public_path('images'), $nama_logo);
        } else {
            $nama_logo = DB::table('instansis')->where('id', $id)->value("logo");
        }

        $data = DB::table( 'instansis' )->where('id', $id)->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "logo" => $nama_logo,
            "telp" => $request->telp,
            "email" => $request->email,
            "keterangan" =>$request->keterangan
        ]);

        return redirect()->route('instansi.index')
                        ->with('success', 'Berhasil ubah data instansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = DB::table('instansis')->where( 'id' , $id )->first();
        // return response()->json($data);

        // cari kolom "logo"
        $logo = DB::table('instansis')->where( 'id', $id )->value('logo');

        // hapus logo dari folder "images"
        unlink( public_path('images/' .$logo) );

        $data = DB::table('instansis')->where( 'id', $id )->delete();
        // return response()->json($logo);

        return redirect()->route('instansi.index')
            ->with('success', 'Berhasil hapus data instansi');

    }
}
