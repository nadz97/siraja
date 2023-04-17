<?php

namespace App\Http\Controllers;

use DateTimeZone;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Penelitian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:peneliti-list|peneliti-create|peneliti-edit|peneliti-delete', ['only' => ['index','show']]);
         $this->middleware('permission:peneliti-create', ['only' => ['create','store']]);
         $this->middleware('permission:peneliti-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:peneliti-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $penelitians = DB::table('penelitians AS pnl')
                ->join('terdakwas AS tdw', 'pnl.terdakwa_id', '=', 'tdw.id')
                ->select('pnl.*', 'tdw.nama')
                ->get();

        return view('home.penelitian.index', compact('penelitians'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saksi = DB::table('saksis')->get();

        $terdakwa = DB::table('terdakwas')->get();
        $instansis = DB::table('instansis')->get();
        $user = DB::table('users')->get();
        $jabatans = DB::table('jabatans')->select('id', 'jabatan')->where('jabatan', 'Jaksa')->get();
        $pegawai = DB::table('pegawais AS pgw')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->join('instansis AS ins', 'pgw.instansi_id', '=', 'ins.id')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->get();

        // Saksi form
        $jabatan_saksis = DB::table('jabatans')->select('id', 'jabatan')->where('jabatan', 'Saksi')->get();

        $jabatan_pegawai = DB::table('jabatans')->select('id', 'jabatan')->whereIn('jabatan', ['Kasi BB', 'Penyidik', 'Penyerah', 'Petugas Basan', 'Peneliti', 'Kepala Rupbasan'])->get();

        // return response()->json($jabatan_pegawai);
        return view('home.penelitian.create',
            compact('terdakwa', 'pegawai', 'jabatans', 'instansis', 'user', 'jabatan_saksis', 'jabatan_pegawai'));
    }

    public function simpanjaksa(Request $request)
    {
        $nama_photo = "";
        $id = Str::uuid()->toString();

        if ( $request->hasFile("photo")) {
            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $simpan = DB::table('jaksas')->insert([
            "id" => $id,
            "name" => $request->name,
            "NIP" => $request->NIP,
            "instansi_id" => $request->instansi_id,
            "jabatan_id" => $request->jabatan_id,
            "pangkat" => $request->pangkat,
            "alamat" => $request->alamat,
            "no_ktp" => $request->no_ktp,
            "photo" => $nama_photo,
            "biodata" => $request->biodata,

        ]);

        $jaksas = [
            'id' => $id,
            'name' => $request->name
        ];

        return response()->json($jaksas);

    }

    public function simpanterdakwa(Request $request)
    {
        $nama_photo = "";
        $id = Str::uuid()->toString();

        if ( $request->hasFile("photo")) {
            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $simpan = DB::table("terdakwas")->insert([
            "id" => $id,
            "nama" => $request->nama,
            "jabatan" => $request->jabatan,
            "pangkat" => $request->pangkat,
            "alamat" => $request->alamat,
            "no_ktp" => $request->no_ktp,
            "photo" => $nama_photo,
            "biodata" => $request->biodata
        ]);

        $terdakwas = [
            'id' => $id,
            'nama' => $request->nama
        ];

        return response()->json($terdakwas);
    }

    public function simpanpegawai(Request $request)
    {
        $nama_photo = "";


        if ( $request->hasFile("photo")) {
            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $hash_password = Hash::make($request->password);

        $id = Str::uuid()->toString();
        $save_usr = new User([
            "id" => $id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hash_password
        ]);
        $save_usr->save();

        $id_pgw = Str::uuid()->toString();
        $save_pgw = new Pegawai([
            "id" => $id_pgw,
            "user_id" => $save_usr->id,
            "instansi_id" => $request->instansi_id,
            "nip" => $request->nip,
            "jabatan_id" => $request->jabatan_id,
            "pangkat" => $request->pangkat,
            "alamat" => $request->alamat,
            "no_ktp" => $request->no_ktp,
            "photo" => $nama_photo,
            "biodata" => $request->biodata
        ]);
        $save_pgw->save();

        $pgw_new = [
            'id' => $id,
            'name' => $request->name
        ];

        return response()->json($pgw_new);
    }

    public function simpansaksi(Request $request)
    {
        $nama_photo = "";
        $id = Str::uuid()->toString();

        if ( $request->hasFile("photo")) {
            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $simpan = DB::table('saksis')->insert([
            "id" => $id,
            "name" => $request->name,
            "NIP" => $request->NIP,
            "jabatan_id" => $request->jabatan_id,
            "pangkat" => $request->pangkat,
            "alamat" => $request->alamat,
            "no_ktp" => $request->no_ktp,
            "photo" => $nama_photo,
            "biodata" => $request->biodata,
        ]);

        $saksi_new = [
            'id' => $id,
            'name' => $request->name
        ];

        return response()->json($saksi_new);
    }

    public function getterdakwa(Request $request)
    {
        $terdakwa = DB::table('terdakwas AS tdw')
            ->where(function ($query) use ($request) {
                $query->where('tdw.nama', 'LIKE', '%' . $request->searchTerm . '%');
            })
            ->get();

        $terdakwas = $terdakwa->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->nama
            ];
        });

        // dd($terdakwa);
        // dd($terdakwas);

        return response()->json($terdakwas);

    }

    public function getjaksa(Request $request)
    {

        $jaksa = DB::table('jaksas AS jks')
                ->join('jabatans AS jbt', 'jks.jabatan_id' , '=' , 'jbt.id')
                ->select('jks.*', 'jbt.jabatan')
                ->where(function ($query) use ($request) {
                    $query->where('jks.name', 'LIKE', '%' . $request->searchTerm . '%')
                          ->orWhere('jbt.jabatan', 'LIKE', '%' . $request->searchTerm . '%');
                })
                ->get();

        $jaksas = $jaksa->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($jaksas);

    }

    public function getsaksi(Request $request)
    {
        $saksi = DB::table('saksis AS sks')
            ->where(function ($query) use ($request) {
                $query->where('sks.name', 'LIKE', '%' . $request->searchTerm . '%');
            })
            ->get();

        $saksis = $saksi->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($saksis);
    }

    public function getpeneliti(Request $request)
    {
        $peneliti = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'peneliti')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $penelitis = $peneliti->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($penelitis);
    }

    public function getRupbasan(Request $request)
    {
        $rupbasan = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'Kepala Rupbasan')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $rupbasans = $rupbasan->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($rupbasans);
    }

    public function getkasibb(Request $request)
    {
        $kasibb = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'kasi bb')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $kasibbs = $kasibb->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($kasibbs);
    }

    public function getpenyidik(Request $request)
    {
        $penyidik = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'penyidik')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $penyidiks = $penyidik->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($penyidiks);
    }

    public function getpenyerah(Request $request)
    {
        $penyerah = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'penyerah')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $penyerahs = $penyerah->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($penyerahs);
    }

    public function getpetugas(Request $request)
    {
        $petugas = DB::table('pegawais AS pgw')
                ->select('pgw.id', 'usr.name')
                ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
                ->join('users AS usr', 'pgw.user_id', '=', 'usr.id')
                ->where('jbt.jabatan', '=', 'petugas basan')
                ->where('usr.name', 'LIKE', '%' . $request->searchTerm . '%')
                ->get();

        $petugass = $petugas->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->name
            ];
        });

        return response()->json($petugass);
    }



    public function getnipsaksi(Request $request)
    {
        $id = $request->id;

        $nip = DB::table('saksis')->where('id', $id)->value('NIP');

        return response()->json(['nip' => $nip]);
    }



    public function getnip(Request $request)
    {
        $id = $request->id;

        $nip = DB::table('jaksas')->where('id', $id)->value('NIP');

        return response()->json(['nip' => $nip]);
    }

    public function getnippnl(Request $request)
    {
        $id = $request->id;

        $nip = DB::table('pegawais')->where('id', $id)->value('NIP');

        return response()->json(['nip' => $nip]);
    }

    public function getnippgw(Request $request)
    {
        $id = $request->id;

        $data = DB::table('pegawais AS pgw')
            ->select('pgw.nip', 'jbt.jabatan', 'pgw.pangkat')
            ->join('jabatans AS jbt', 'pgw.jabatan_id', '=', 'jbt.id')
            ->where('pgw.id', $id)
            ->first();

        // dd($data);
        return response()->json([
            'nip' => $data->nip,
            'pangkat' => $data->pangkat,
            'jabatan' => $data->jabatan
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenelitianRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'no_penelitian' => 'required|unique:penelitians,no_penelitian',
            'no_registrasi_perkara' => 'required|unique:penelitians,no_registrasi_perkara',
            'no_registrasi_bb' => 'required|unique:penelitians,no_registrasi_bb',
            'surat_perintah' => 'required',

            'tanggal_sp' => 'required',
            'pasal' => 'required',
            'keterangan_terdakwa' => 'required',
            'peneliti_sk' => 'required',

            'terdakwa_id' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
            'jaksa1' => 'required',

            'jaksa2' => 'required',
            'penyidik' => 'required',
            'kasi_bb' => 'required',
            'petugas' => 'required',

            'penyerah' => 'required',
            'peneliti1' => 'required',
            'peneliti2' => 'required',
            'peneliti3' => 'required',
            'kepala_rupbasan' => 'required',

        ]);

        $penelitian_id = Str::uuid()->toString();

        $penelitian = Penelitian::create([
            "id" => $penelitian_id,
            "tanggal" => $request->tanggal,
            "no_penelitian" => $request->no_penelitian,
            "no_registrasi_perkara" => $request->no_registrasi_perkara,
            "no_registrasi_bb" => $request->no_registrasi_bb,
            "surat_perintah" => $request->surat_perintah,
            "tanggal_sp" => $request->tanggal_sp,
            "pasal" => $request->pasal,
            "terdakwa_id" => $request->terdakwa_id,
            "keterangan_terdakwa" => $request->keterangan_terdakwa,
            "jaksa1" => $request->jaksa1,
            "jaksa2" => $request->jaksa2,
            "saksi1" => $request->saksi1,
            "saksi2" => $request->saksi2,
            "penyidik" => $request->penyidik,
            "kasi_bb" => $request->kasi_bb,
            "petugas" => $request->petugas,
            "penyerah" => $request->penyerah,
            "peneliti_sk" => $request->peneliti_sk,
            "peneliti1" => $request->peneliti1,
            "peneliti2" => $request->peneliti2,
            "peneliti3" => $request->peneliti3,
            "kepala_rupbasan" => $request->kepala_rupbasan,

        ]);

        return redirect()->route('penelitian.index')
                        ->with('success', 'Data penelitian berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */

    public function tambahBasan($id, $nrp)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id", $user_id)->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();

        return view("home.penelitian.basan", compact('instansi', 'id', 'nrp'));
    }

    public function tambahRekomendasi($id)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id", $user_id)->value("instansi_id");
        $instansi = DB::table("instansis AS ins")
                    ->when( auth()->user()->hasRole('Admin') == false , function ($query) use ($ins_id) {
                        return $query->where('ins.id', '=', '$ins_id');
                    })
                    ->get();

        return view("home.rekomendasi.create", compact('ins_id', 'id'));
    }

    public function simpanRekomendasi( Request $request )
    {
        $id = Str::uuid()->toString();

        $rekom = DB::table("rekomendasis")->insert([
            "id" => $id,
            "penelitian_id" => $request->id,
            "rekomendasi" => $request->rekomendasi
        ]);

        return redirect()->route('admin.detailPenelitian', $request->id )
                        ->with('success','Data Rekomendasi berhasil ditambahkan');
    }



    public function limpahkanBasan($id, $nrp)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id", $user_id)->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();

        $basan = DB::table('basans')->where('penelitian_id', $id)->paginate(5);

        return view("home.penelitian.limpahkan", compact('instansi', 'id', 'nrp', 'basan'));
    }

    public function simpanBasan(Request $request)
    {
        $this->validate($request, [
            'no' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
            'golongan' => 'required',
            'kondisi' => 'required',
            'bentuk' => 'required',
            'berat' => 'required',
            'tinggi' => 'required',
            'ciri' => 'required',
            'sifat' => 'required',
            'keadaan' => 'required',

        ]);

        $nama_photo = "";
        $id = Str::uuid()->toString();

        if ( $request->hasFile("photo")) {
            $nama_photo = rand(pow(10, 3 - 1), pow(10, 3) - 1) . "-" .
                $request->file('photo')->getClientOriginalName();

            $request->photo->move(public_path('images'), $nama_photo);
        }

        $basan = DB::table('basans')->insert([
            'id' => $id,
            'penelitian_id' =>$request->penelitian_id,
            'no' =>$request->no,
            'nama' =>$request->nama,
            'photo' =>$nama_photo,
            'keterangan' =>$request->keterangan,
            'jumlah' =>$request->jumlah,
            'golongan' =>$request->golongan,
            'kondisi' =>$request->kondisi,
            'bentuk' =>$request->bentuk,
            'berat' =>$request->berat,
            'tinggi' =>$request->tinggi,
            'ciri' =>$request->ciri,
            'sifat' =>$request->sifat,
            'keadaan' =>$request->keadaan,
        ]);

        return redirect()->route('penelitian.index')
                        ->with('success', 'Data Penelitian berhasil di simpan');
    }

    public function ubahStatusBasan(Request $request)
    {
        $basan = DB::table('basans')
                ->where('id', $request->id)
                ->update(['status' => $request->status ]);

        return response()->json(['success' => 'data dengan id ' . $request->id . 'berhasil diupdate']);
    }

    public function detailPenelitian( $id )
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id" , $user_id )->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();

        $rekomendasi = DB::table("rekomendasis AS rek")
                    ->join("penelitians AS pnl", "rek.penelitian_id", "=", "pnl.id")
                    ->where("rek.penelitian_id", $id)
                    ->select("rek.rekomendasi", "rek.id", "rek.penelitian_id")
                    ->get();

        // $data = DB::table("basans")->where("penelitian_id", $id)->paginate(5);
        $data = DB::table("penelitians AS pnl")
                    ->join("basans AS bsn", "bsn.penelitian_id", "=", "pnl.id")
                    ->join("terdakwas AS tdw", "pnl.terdakwa_id", "=", "tdw.id")
                    ->where("pnl.id", $id)
                    ->select("pnl.id", "pnl.tanggal AS tanggal", "pnl.no_penelitian", "tdw.nama AS tdw_nama", "pnl.no_registrasi_perkara"
                            , "pnl.keterangan_terdakwa", "bsn.no", "bsn.nama AS nama_basan", "bsn.photo" , "bsn.id AS id_basan"
                            , "bsn.jumlah", "bsn.keterangan", "bsn.status")

                    ->get();

        // return response()->json($rekomendasi);

        return view("home.penelitian.detail_peneliti", compact("rekomendasi", "data") );
    }

    public function printPenelitian($id)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id" , $user_id )->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();

        $rekomendasi = DB::table("rekomendasis AS rek")
                    ->join("penelitians AS pnl", "rek.penelitian_id", "=", "pnl.id")
                    ->where("rek.penelitian_id", $id)
                    ->select("rek.rekomendasi")
                    ->get();

        // $data = DB::table("basans")->where("penelitian_id", $id)->paginate(5);
        $data = DB::table("penelitians AS pnl")
                    ->join("basans AS bsn", "bsn.penelitian_id", "=", "pnl.id")
                    ->join("terdakwas AS tdw", "pnl.terdakwa_id", "=", "tdw.id")
                    ->where("pnl.id", $id)
                    ->select("pnl.id", "pnl.pasal", "pnl.tanggal AS tanggal", "pnl.no_penelitian", "pnl.surat_perintah", "pnl.tanggal","tdw.nama AS tdw_nama", "pnl.no_registrasi_perkara"
                            ,"pnl.penyidik" ,"pnl.no_registrasi_bb" , "pnl.keterangan_terdakwa", "bsn.no", "bsn.nama AS nama_basan", "bsn.photo", "pnl.jaksa1", "pnl.jaksa2"
                            , "pnl.saksi1", "pnl.saksi2", "kasi_bb"
                            , "bsn.jumlah", "bsn.keterangan", "bsn.status")
                    ->get();

        // $id_jaksa = DB::table("jabatans")->where("jabatans", "=", "Jaksa")->value("id");
        // $jaksa = DB::table("pegawais")->where("jabatan_id", "=", $id_jaksa)->get();

        $jaksas1 = DB::table('jaksas AS jks')
                    ->join("jabatans AS jbt", "jks.jabatan_id", "=", "jbt.id")
                    ->where("jks.id", $data[0]->jaksa1)
                    ->select("jks.name", "jks.pangkat", "jbt.jabatan", "jks.nip")
                    ->get();

        // return response()->json($jaksas1);
        // dd($jaksas1);

        $jaksas2 = DB::table('jaksas AS jks')

                    ->join("jabatans AS jbt", "jks.jabatan_id", "=", "jbt.id")
                    ->where("jks.id", $data[0]->jaksa2)
                    ->select("jks.name", "jks.pangkat", "jbt.jabatan", "jks.nip")
                    ->get();

        $saksi1 = DB::table('saksis AS sks')

                    ->where('sks.id', '=', $data[0]->saksi1)
                    ->select('sks.name', 'sks.nip', 'sks.pangkat')
                    ->first();

        $saksi2 = DB::table('saksis AS sks')

                    ->where('sks.id', '=', $data[0]->saksi2)
                    ->select('sks.name', 'sks.nip', 'sks.pangkat')
                    ->first();

        $basan = DB::table("basans")
                    ->where("penelitian_id", "=", "$id")
                    ->select("nama")
                    ->get();

        $penyidik = DB::table("pegawais AS pgw")
                    ->join("users AS usr", "pgw.user_id", "=", "usr.id")
                    ->join("jabatans AS jbt", "pgw.jabatan_id", "=", "jbt.id")
                    ->where("pgw.id", $data[0]->penyidik)
                    ->select("usr.name", "pgw.pangkat", "jbt.jabatan", "pgw.nip")
                    ->first();

        // dd($penyidik);

        $kasi_bb = DB::table("pegawais AS pgw")
                    ->join("users AS usr", "pgw.user_id", "=", "usr.id")
                    ->join("jabatans AS jbt", "pgw.jabatan_id", "=", "jbt.id")
                    ->where("pgw.id", $data[0]->kasi_bb)
                    ->select("usr.name", "pgw.pangkat", "jbt.jabatan", "pgw.nip")
                    ->first();

        $tanggal = Carbon::parse($data[0]->tanggal)->locale('id');

        $tanggal->settings(['formatFunction' => 'translatedFormat']);

        $tgl = $tanggal->format('l, j F Y');
        $tg = $tanggal->format('j F Y');

        return view('home.penelitian.print_penelitian', compact("tg", "rekomendasi", "data", "jaksas1", "jaksas2", "saksi1", "saksi2", "basan", "penyidik", "tgl", "kasi_bb"));
    }

    public function printPenitipan($id)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id" , $user_id )->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();

        $rekomendasi = DB::table("rekomendasis AS rek")
                    ->join("penelitians AS pnl", "rek.penelitian_id", "=", "pnl.id")
                    ->where("rek.penelitian_id", $id)
                    ->select("rek.rekomendasi", "rek.penelitian_id", "rek.id")
                    ->get();

        // $data = DB::table("basans")->where("penelitian_id", $id)->paginate(5);
        $data = DB::table("penelitians AS pnl")
                    ->join("basans AS bsn", "bsn.penelitian_id", "=", "pnl.id")
                    ->join("terdakwas AS tdw", "pnl.terdakwa_id", "=", "tdw.id")
                    ->where("pnl.id", $id)
                    ->select("pnl.id","pnl.kepala_rupbasan" , "pnl.pasal", "pnl.tanggal AS tanggal", "pnl.no_penelitian", "pnl.surat_perintah", "pnl.tanggal","tdw.nama AS tdw_nama", "pnl.no_registrasi_perkara"
                            ,"pnl.penyidik" ,"pnl.no_registrasi_bb" , "pnl.keterangan_terdakwa", "bsn.no", "bsn.nama AS nama_basan", "bsn.photo", "pnl.jaksa1", "pnl.jaksa2"
                            , "pnl.saksi1", "pnl.saksi2", "kasi_bb"
                            , "bsn.jumlah", "bsn.keterangan", "bsn.status")
                    ->get();

        // $id_jaksa = DB::table("jabatans")->where("jabatans", "=", "Jaksa")->value("id");
        // $jaksa = DB::table("pegawais")->where("jabatan_id", "=", $id_jaksa)->get();

        $jaksas1 = DB::table('jaksas AS jks')
                    ->join("jabatans AS jbt", "jks.jabatan_id", "=", "jbt.id")
                    ->where("jks.id", $data[0]->jaksa1)
                    ->select("jks.name", "jks.pangkat", "jbt.jabatan", "jks.nip")
                    ->get();

        // return response()->json($jaksas1);
        // dd($jaksas1);

        $jaksas2 = DB::table('jaksas AS jks')

                    ->join("jabatans AS jbt", "jks.jabatan_id", "=", "jbt.id")
                    ->where("jks.id", $data[0]->jaksa2)
                    ->select("jks.name", "jks.pangkat", "jbt.jabatan", "jks.nip")
                    ->get();

        $saksi1 = DB::table('saksis AS sks')

                    ->where('sks.id', '=', $data[0]->saksi1)
                    ->select('sks.name', 'sks.nip', 'sks.pangkat')
                    ->first();

        $saksi2 = DB::table('saksis AS sks')

                    ->where('sks.id', '=', $data[0]->saksi2)
                    ->select('sks.name', 'sks.nip', 'sks.pangkat')
                    ->first();

        $basan = DB::table("basans")
                    ->where("penelitian_id", "=", "$id")
                    ->select("nama")
                    ->get();

        $penyidik = DB::table("pegawais AS pgw")
                    ->join("users AS usr", "pgw.user_id", "=", "usr.id")
                    ->join("jabatans AS jbt", "pgw.jabatan_id", "=", "jbt.id")
                    ->where("pgw.id", $data[0]->penyidik)
                    ->select("usr.name", "pgw.pangkat", "jbt.jabatan", "pgw.nip")
                    ->first();

        // dd($penyidik);

        $kasi_bb = DB::table("pegawais AS pgw")
                    ->join("users AS usr", "pgw.user_id", "=", "usr.id")
                    ->join("jabatans AS jbt", "pgw.jabatan_id", "=", "jbt.id")
                    ->where("pgw.id", $data[0]->kasi_bb)
                    ->select("usr.name", "pgw.pangkat", "jbt.jabatan", "pgw.nip")
                    ->first();

        $tanggal = Carbon::parse($data[0]->tanggal)->locale('id');

        $tanggal->settings(['formatFunction' => 'translatedFormat']);

        $kepala_rupbasan = DB::table("pegawais AS pgw")
                    ->join("users AS usr", "pgw.user_id", "=", "usr.id")
                    ->join("jabatans AS jbt", "pgw.jabatan_id", "=", "jbt.id")
                    ->where("pgw.id", $data[0]->kepala_rupbasan)
                    ->select("usr.name", "pgw.pangkat", "jbt.jabatan", "pgw.nip", "pgw.alamat")
                    ->first();

        $tgl = $tanggal->format('l, j F Y');
        $tg = $tanggal->format('j F Y');

        return view('home.penelitian.print_penitipan', compact("kepala_rupbasan" ,"tg", "rekomendasi", "data", "jaksas1", "jaksas2", "saksi1", "saksi2", "basan", "penyidik", "tgl", "kasi_bb"));
    }

    public function show(Penelitian $penelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penelitian $penelitian)
    {
        //
    }

    public function ubahBasan($id)
    {
        $user_id = Auth::user()->id;

        $ins_id = DB::table("pegawais AS pgw")->where("user_id", $user_id)->value("instansi_id");
        $instansi = DB::table("instansis")->where("id", $ins_id)->first();
        $basan = DB::table("basans AS bsn")->where("id", "=", $id)->first();
        // return response()->json($basan);

        return view("home.penelitian.ubah_basan", compact("basan", "instansi", "id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenelitianRequest  $request
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenelitianRequest $request, Penelitian $penelitian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penelitian  $penelitian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penelitian $penelitian)
    {
        $penelitian = DB::table('penelitians')->where("id" , $id)->delete();

        return redirect()->route('penelitian.index')
                        ->with('success', 'Data Penelitian berhasil dihapus');
    }

    public function hapusRekomendasi($id, $pnl)
    {
        $rekom = DB::table('rekomendasis')->where("id", $id)->delete();
        return redirect()->route('admin.detailPenelitian', $pnl)
                        ->with('success','Data rekomendasi berhasil ditambahkan');
    }
}
