@extends('layouts.app-master')

@push('scripts')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endpush

@section('content')
    @auth
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="car">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">Tambah Penelitian</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    {!! Form::open(['route' => 'penelitian.store', 'method' => 'POST', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong> Tanggal :</strong>
                                                <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nomor Penelitian :</strong>
                                                <input type="text" name="no_penelitian" value="{{ old('no_penelitian') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nomor Registrasi :</strong>
                                                <input type="text" name="no_registrasi_perkara" value="{{ old('no_registrasi_perkara') }}" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong> Tanggal Surat Perintah :</strong>
                                                <input type="date" name="tanggal_sp" value="{{ old('tanggal_sp') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Surat Perintah :</strong>
                                                <input type="text" name="surat_perintah" value="{{ old('surat_perintah') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nomor Registrasi BB :</strong>
                                                <input type="text" name="no_registrasi_bb" value="{{ old('no_registrasi_bb') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="horizontal dark mt-4">

                                    <div class="row mt-2">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Pasal Yang Didakwakan :</strong>
                                                <input type="text" name="pasal" value="{{ old('pasal') }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nama Terdakwa :</strong>
                                                <select name="terdakwa_id" value="{{ old('terdakwa_id') }}" class="form-select" id="terdakwa_id">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <br>
                                                    <button id="btn-terdakwa" class="btn btn-primary btn-sm">...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Keterangan Terdakwa :</strong>
                                                <textarea name="keterangan_terdakwa" id="ket-terdakwa" value="{{ old('keterangan_terdakwa') }}" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <hr>

                                    {{-- double row jaksa --}}
                                    <div class="row mt-4">

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Jaksa 1</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="jaksa1" id="jaksa1"  class="form-control">
                                                            <option value="">Pilih Jaksa</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="jaksa_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <br>
                                                            <button id="btn-jaksa" class="btn btn-primary btn-sm">Tambah Jaksa</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Jaksa 2</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="jaksa2" id="jaksa2" class="form-control">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="jaksa_nip2" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- double row end --}}

                                    <hr class="horizontal dark mt-4">
                                    {{-- double row saksi --}}
                                    <div class="row mt-4">

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Saksi 1</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="saksi1" id="saksi1" class="form-control">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="saksi1_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <br>
                                                            <button id="btn-saksi" class="btn btn-primary btn-sm">Tambah Saksi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Saksi 2</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="saksi2" id="saksi2" class="form-control">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="saksi2_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- double row end --}}

                                    <hr class="horizontal dark mt-4">

                                    {{-- double row kasi BB and Penyidik --}}
                                    <div class="row mt-4">

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Kasi BB</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="kasi_bb" id="kasi_bb" class="form-control">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="kasi_bb_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <br>
                                                            <button id="btn-pgw" class="btn btn-primary btn-sm">Tambah Pegawai</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="horizontal dark mt-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama Penyerah :</strong>
                                                        <select name="penyerah" id="penyerah_id">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP Penyerah :</strong>
                                                        <input type="text" id="penyerah_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Penyidik</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="penyidik" id="penyidik" class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="penyidik_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row invisible">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <br>
                                                            <button class="invisible btn btn-primary btn-sm">Tambah Pegawai</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="horizontal dark mt-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama Petugas di Rubasan :</strong>
                                                        <select name="petugas" id="petugas_id">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP Petugas di Rubasan :</strong>
                                                        <input type="text" id="petugas_nip" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    {{-- double row end --}}

                                    <div class="row mt-4">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <strong> Peneliti SK :</strong>
                                                <input name="peneliti_sk" class="form-control"></input>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Triple row Peniliti --}}
                                    <div class="row mt-4">

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Peneliti 1</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="peneliti1" id="peneliti1" class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="pnl_nip1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Jabatan :</strong>
                                                        <input type="text" id="pnl_jabatan1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Pangkat :</strong>
                                                        <input type="text" id="pnl_pangkat1" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <br>
                                                            <button class="btn btn-primary btn-sm" id="btn-pnl">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Peneliti 2</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="peneliti2" id="peneliti2" class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="pnl_nip2" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Jabatan :</strong>
                                                        <input type="text" id="pnl_jabatan2" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Pangkat :</strong>
                                                        <input type="text" id="pnl_pangkat2" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <label for="">Peneliti 3</label>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Nama :</strong>
                                                        <select name="peneliti3" id="peneliti3" class="form-control"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> NIP :</strong>
                                                        <input type="text" id="pnl_nip3" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Jabatan :</strong>
                                                        <input type="text" id="pnl_jabatan3" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <strong> Pangkat :</strong>
                                                        <input type="text" id="pnl_pangkat3" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- double row end --}}

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label for="">Kepala Rupbasan</label>
                                            <select name="kepala_rupbasan" id="rupbasan_id">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">NIP Kepala Rupbasan</label>
                                            <input type="text" id="nip_rupbasan" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <button name="simpan" type='submit' class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        {{-- modal section terdakwa--}}
        <div class="modal fade" tabindex="-1" role="dialog" id="mdl-terdakwa">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fs-5"> Tambah Terdakwa </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="my-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="input-nama"> Nama Lengkap :</label>
                                    <input type="text" name="nama" id="td_nama" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label for="input-jabatan"> Jabatan :</label>
                                    <input type="text" name="jabatan" id="td_jabatan" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="input-pangkat"> Pangkat :</label>
                                    <input type="text" name="pangkat" id="td_pangkat" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-ktp">No KTP :</label>
                                    <input type="text" name="no_ktp" id="td_ktp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-photo">Photo :</label>
                                    <input type="file" name="photo" id="td_photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="td_alamat" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Biodata</label>
                                    <textarea class="form-control" name="biodata" id="td_biodata" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" id="btn-simpan-terdakwa">Simpan</button>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        {{-- end modal section --}}

        {{-- modal section jaksa--}}
        <div class="modal fade" tabindex="-1" role="dialog" id="mdl-jaksa">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fs-5"> Tambah Jaksa </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-jaksa">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> Nama Jaksa :</strong>
                                        <input type="text" name="name" id="jk_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> Instansi :</strong>
                                        <select name="instansi_id" aria-placeholder="Pilih Instansi" class="form-select" id="instansi_id">
                                            <option value="">Pilih Instansi</option>
                                            @foreach ($instansis as $ins)
                                                <option value="{{$ins->id}}">{{$ins->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> NIP :</strong>
                                        <input type="text" name="NIP" id="jk_nip" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> Jabatan :</strong>
                                        <select name="jabatan_id" id="jabatan_id" class="form-control">
                                            @foreach($jabatans as $jabatan)
                                                <option value="{{ $jabatan->id }}" readonly>{{ $jabatan->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <strong> Pangkat :</strong>
                                        <input type="text" name="pangkat" id="jk_pangkat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="input-ktp">No KTP :</label>
                                    <input type="text" name="no_ktp" id="jk_ktp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-photo">Photo :</label>
                                    <input type="file" name="photo" id="jk_photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="jk_alamat" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Biodata</label>
                                    <textarea class="form-control" name="biodata" id="jk_biodata" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" id="btn-simpan-jaksa">Simpan</button>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        {{-- end modal section --}}

        {{-- modal section saksi--}}
        <div class="modal fade" tabindex="-1" role="dialog" id="mdl-saksi">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fs-5"> Tambah Saksi </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-saksi">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> Nama Saksi :</strong>
                                        <input type="text" name="name" id="sk_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> NIP :</strong>
                                        <input type="text" name="NIP" id="sk_nip" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong> Jabatan :</strong>
                                        <select name="jabatan_id" id="sk_jabatan_id" class="form-control">
                                            @foreach($jabatan_saksis as $jbs)
                                                <option value="{{ $jbs->id }}" readonly>{{ $jbs->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <strong> Pangkat :</strong>
                                        <input type="text" name="pangkat" id="sk_pangkat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="input-ktp">No KTP :</label>
                                    <input type="text" name="no_ktp" id="sk_ktp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-photo">Photo :</label>
                                    <input type="file" name="photo" id="sk_photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="sk_alamat" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Biodata</label>
                                    <textarea class="form-control" name="biodata" id="sk_biodata" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" id="btn-simpan-saksi">Simpan</button>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        {{-- end modal section --}}

        {{-- modal section pegawai--}}
        <div class="modal fade" tabindex="-1" role="dialog" id="mdl-pgw">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fs-5"> Tambah Pegawai </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-pgw">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Nama Pegawai :</strong>
                                        <input type="text" name="name" id="pgw_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Email :</strong>
                                        <input type="email" name="email" id="pgw_email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Password :</strong>
                                        <input type="password" name="password" id="pgw_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> NIP :</strong>
                                        <input type="text" name="nip" id="pgw_nip" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Instansi :</strong>
                                        <select name="instansi_id" id="pgw_instansi_id" class="form-select">
                                            @foreach($instansis as $ins)
                                                <option value="{{ $ins->id }}">{{ $ins->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Jabatan :</strong>
                                        <select name="jabatan_id" id="pgw_jabatan_id" class="form-select">
                                            @foreach($jabatan_pegawai as $jbt_pgw)
                                                <option value="{{ $jbt_pgw->id }}" >{{ $jbt_pgw->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <strong> Pangkat :</strong>
                                        <input type="text" name="pangkat" id="pgw_pangkat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="input-ktp">No KTP :</label>
                                    <input type="text" name="no_ktp" id="pgw_ktp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-photo">Photo :</label>
                                    <input type="file" name="photo" id="pgw_photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="pgw_alamat" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Biodata</label>
                                    <textarea class="form-control" name="biodata" id="pgw_biodata" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" id="btn-simpan-pegawai">Simpan</button>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        {{-- end modal section --}}

        {{-- modal section Peneliti--}}
        <div class="modal fade" tabindex="-1" role="dialog" id="mdl-pnl">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title fs-5"> Tambah Peneliti </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-pnl">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Nama Peneliti :</strong>
                                        <input type="text" name="name" id="pnl_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Email :</strong>
                                        <input type="email" name="email" id="pnl_email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Password :</strong>
                                        <input type="password" name="password" id="pnl_password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> NIP :</strong>
                                        <input type="text" name="nip" id="pnl_nip" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Instansi :</strong>
                                        <select name="instansi_id" id="pnl_instansi_id" class="form-select">
                                            @foreach($instansis as $ins)
                                                <option value="{{ $ins->id }}">{{ $ins->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong> Jabatan :</strong>
                                        <select name="jabatan_id" id="pnl_jabatan_id" class="form-select">
                                            @foreach($jabatan_pegawai as $jbt_pnl)
                                                <option value="{{ $jbt_pnl->id }}" >{{ $jbt_pnl->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <strong> Pangkat :</strong>
                                        <input type="text" name="pangkat" id="pnl_pangkat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="input-ktp">No KTP :</label>
                                    <input type="text" name="no_ktp" id="pnl_ktp" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="input-photo">Photo :</label>
                                    <input type="file" name="photo" id="pnl_photo" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="pnl_alamat" cols="30" rows="10"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Biodata</label>
                                    <textarea class="form-control" name="biodata" id="pnl_biodata" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" id="btn-simpan-peneliti">Simpan</button>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        {{-- end modal section --}}

    @endauth

    @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
    @endguest

    @push('body-scripts')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#rupbasan_id").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih rupbasan",
                ajax: {
                        url: "{{ route('admin.getRupbasan') }}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#rupbasan_id').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#rupbasan_id').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#rupbasan_nip').val(res.nip);
                    }
                });
            });

            $("#penyerah_id").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Penyerah",
                ajax: {
                        url: "{{ route('admin.getpenyerah')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#penyerah_id').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#penyerah_id').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#penyerah_nip').val(res.nip);
                    }
                });
            });

            $("#petugas_id").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Petugas",
                ajax: {
                        url: "{{ route('admin.getpetugas')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#petugas_id').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#petugas_id').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }


            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#petugas_nip').val(res.nip);
                    }
                });
            });

            $("#terdakwa_id").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Terdakwa",
                ajax: {
                        url: "{{ route('admin.getterdakwa')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#terdakwa_id').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nama
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#terdakwa_id').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            });


            $('#jaksa1').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Jaksa",
                ajax: {
                        url: "{{ route('admin.getjaksa')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#jaksa1').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#jaksa1').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnip')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#jaksa_nip').val(res.nip);
                    }
                });
            });

            $('#jaksa2').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Jaksa",
                ajax: {
                        url: "{{ route('admin.getjaksa')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#jaksa2').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#jaksa2').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnip')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#jaksa_nip2').val(res.nip);
                    }
                });
            });

            $('#saksi1').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Saksi",
                ajax: {
                        url: "{{ route('admin.getsaksi')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#saksi1').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#saksi1').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                    // Get the selected option value
                    var selectedValue = $(this).val();
                    // Send an AJAX request to retrieve the NIP value from the server
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.getnipsaksi')}}",
                        data: { id: selectedValue },
                        dataType: "JSON",
                        success: function (res) {
                        // Set the value of the NIP input field
                            $('#saksi1_nip').val(res.nip);
                        }
                    });
            });

            $('#saksi2').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Saksi",
                ajax: {
                        url: "{{ route('admin.getsaksi')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#saksi1').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#saksi1').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            }).on('change', function() {
                    // Get the selected option value
                    var selectedValue = $(this).val();
                    // Send an AJAX request to retrieve the NIP value from the server
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.getnipsaksi')}}",
                        data: { id: selectedValue },
                        dataType: "JSON",
                        success: function (res) {
                        // Set the value of the NIP input field
                            $('#saksi2_nip').val(res.nip);
                        }
                    });
            });

            $('#peneliti1').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Peneliti",
                ajax: {
                        url: "{{ route('admin.getpeneliti')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#peneliti1').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#peneliti1').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#pnl_nip1').val(res.nip);
                        $('#pnl_pangkat1').val(res.pangkat);
                        $('#pnl_jabatan1').val(res.jabatan);
                    }

                });
            });

            $('#peneliti2').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Peneliti",
                ajax: {
                        url: "{{ route('admin.getpeneliti')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#peneliti2').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#peneliti2').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#pnl_nip2').val(res.nip);
                        $('#pnl_pangkat2').val(res.pangkat);
                        $('#pnl_jabatan2').val(res.jabatan);
                    }
                });
            });

            $('#peneliti3').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Peneliti",
                ajax: {
                        url: "{{ route('admin.getpeneliti')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#peneliti3').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#peneliti3').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }
            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#pnl_nip3').val(res.nip);
                        $('#pnl_pangkat3').val(res.pangkat);
                        $('#pnl_jabatan3').val(res.jabatan);
                    }
                });
            });


            $("#penyidik").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Penyidik",
                ajax: {
                        url: "{{ route('admin.getpenyidik')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#penyidik').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#penyidik').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#penyidik_nip').val(res.nip);
                    }
                });
            });

            $("#kasi_bb").select2({
                theme: 'bootstrap-5',
                allowClear: true,
                placeholder: "Pilih Kasi BB",
                ajax: {
                        url: "{{ route('admin.getkasibb')}}",
                        type: "GET",
                        dataType: 'json',
                        delay: 1000,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            // Get the current data in the Select2 control
                            var currentData = $('#kasi_bb').select2('data');

                            // Append the new options to the current data
                            var newData = currentData.concat($.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }));

                            // Set the new data in the Select2 control
                            $('#kasi_bb').select2('data', newData);

                            return {
                                results: data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.text
                                    }
                                })
                            };
                        }
                    }

            }).on('change', function() {
                // Get the selected option value
                var selectedValue = $(this).val();
                // Send an AJAX request to retrieve the NIP value from the server
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.getnippgw')}}",
                    data: { id: selectedValue },
                    dataType: "JSON",
                    success: function (res) {
                        var NIP = res.nip;
                        // console.log('NIP', NIP);
                    // Set the value of the NIP input field
                        $('#kasi_bb_nip').val(res.nip);
                    }
                });
            });

            $('#btn-terdakwa').click(function (e) {
                e.preventDefault();
                $('#mdl-terdakwa').modal('show');
            });

            $('#btn-jaksa').click(function (e) {
                e.preventDefault();
                $('#mdl-jaksa').modal('show');
            });

            $('#btn-saksi').click(function (e) {
                e.preventDefault();
                $('#mdl-saksi').modal('show');
            });

            $('#btn-pgw').click(function (e) {
                e.preventDefault();
                $('#mdl-pgw').modal('show');
            });

            $('#btn-pnl').click(function (e) {
                e.preventDefault();
                $('#mdl-pnl').modal('show');
            });

            // simpan terdakwa
            $('#btn-simpan-terdakwa').click(function (e) {
                e.preventDefault();

                let td_photo = $('#td_photo')[0].files;
                let td_nama = $("#td_nama").val();
                let td_jabatan = $("#td_jabatan").val();
                let td_pangkat = $("#td_pangkat").val();
                let td_ktp = $("#td_ktp").val();
                let td_alamat = $("#td_alamat").val();
                let td_biodata = $("#td_biodata").val();

                let fd = new FormData();
                fd.append('photo', td_photo[0]);
                fd.append('nama', td_nama);
                fd.append('jabatan', td_jabatan);
                fd.append('pangkat', td_pangkat);
                fd.append('no_ktp', td_ktp);
                fd.append('alamat', td_alamat);
                fd.append('biodata', td_biodata);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.simpanterdakwa')}}",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil di simpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        });

                        $('#mdl-terdakwa').modal('hide');
                        console.log(response.nama);
                        console.log(response.id);
                        // select newly added data
                        var option = new Option(response.nama, response.id, true, true);
                        console.log(option)
                        $('#terdakwa_id').append(option).trigger('change');

                        $('#mdl-terdakwa').on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset(); // reset the form fields
                        });

                    }
                });



            });

            // simpan jaksa
            $('#btn-simpan-jaksa').click(function (e) {
                e.preventDefault();

                let jk_photo = $('#jk_photo')[0].files;
                let jk_nama = $("#jk_name").val();
                let jk_nip = $("#jk_nip").val();
                let jk_jabatan = $("#jabatan_id").val();
                let jk_instansi = $("#instansi_id").val();
                let jk_pangkat = $("#jk_pangkat").val();

                let jk_ktp = $("#jk_ktp").val();
                let jk_alamat = $("#jk_alamat").val();
                let jk_biodata = $("#jk_biodata").val();


                let jks = new FormData();
                jks.append('photo', jk_photo[0]);
                jks.append('name', jk_nama);
                jks.append('NIP', jk_nip);
                jks.append('jabatan_id', jk_jabatan);
                jks.append('instansi_id', jk_instansi);
                jks.append('pangkat', jk_pangkat);
                jks.append('no_ktp', jk_ktp);
                jks.append('alamat', jk_alamat);
                jks.append('biodata', jk_biodata);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.simpanjaksa')}}",
                    data: jks,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil di simpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        });

                        $('#mdl-jaksa').modal('hide');

                        // select newly added data
                        var option = new Option(response.name, response.id, true, true);
                        console.log(option)
                        $('#jaksa1').append(option).trigger('change');

                        $('#mdl-jaksa').on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset(); // reset the form fields
                        });

                    }
                });


            });

            // simpan saksi
            $('#btn-simpan-saksi').click(function (e) {
                e.preventDefault();

                let sk_photo = $('#sk_photo')[0].files;
                let sk_nama = $("#sk_name").val();
                let sk_nip = $("#sk_nip").val();
                let sk_jabatan = $("#sk_jabatan_id").val();
                let sk_pangkat = $("#sk_pangkat").val();

                let sk_ktp = $("#sk_ktp").val();
                let sk_alamat = $("#sk_alamat").val();
                let sk_biodata = $("#sk_biodata").val();

                let sk = new FormData();
                sk.append('photo', sk_photo[0]);
                sk.append('name', sk_nama);
                sk.append('NIP', sk_nip);
                sk.append('jabatan_id', sk_jabatan);
                sk.append('pangkat', sk_pangkat);
                sk.append('no_ktp', sk_ktp);
                sk.append('alamat', sk_alamat);
                sk.append('biodata', sk_biodata);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.simpansaksi')}}",
                    data: sk,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil di simpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        });

                        $('#mdl-saksi').modal('hide');

                        $('#mdl-saksi').on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset(); // reset the form fields
                        });

                    }
                });


            });

            // simpan pegawai
            $('#btn-simpan-pegawai').click(function (e) {
                e.preventDefault();

                let pgw_name = $("#pgw_name").val();
                let pgw_email = $("#pgw_email").val();
                let pgw_password = $("#pgw_password").val();

                let pgw_instansi = $("#pgw_instansi_id").val();
                let pgw_nip = $("#pgw_nip").val();
                let pgw_jabatan = $("#pgw_jabatan_id").val();
                let pgw_pangkat = $("#pgw_pangkat").val();
                let pgw_alamat = $("#pgw_alamat").val();
                let pgw_ktp = $("#pgw_ktp").val();
                let pgw_photo = $('#pgw_photo')[0].files;
                let pgw_biodata = $("#pgw_biodata").val();

                let pgw = new FormData();
                pgw.append('name', pgw_name);
                pgw.append('email', pgw_email);
                pgw.append('password', pgw_password);

                pgw.append('instansi_id', pgw_instansi);
                pgw.append('nip', pgw_nip);
                pgw.append('jabatan_id', pgw_jabatan);
                pgw.append('pangkat', pgw_pangkat);
                pgw.append('alamat', pgw_alamat);
                pgw.append('no_ktp', pgw_ktp);
                pgw.append('photo', pgw_photo[0]);
                pgw.append('biodata', pgw_biodata);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.simpanpegawai')}}",
                    data: pgw,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil di simpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        });

                        $('#mdl-pgw').modal('hide');

                        $('#mdl-pgw').on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset(); // reset the form fields
                        });

                    }
                });


            });

            // simpan peneliti
            $('#btn-simpan-peneliti').click(function (e) {
                e.preventDefault();

                let pnl_name = $("#pnl_name").val();
                let pnl_email = $("#pnl_email").val();
                let pnl_password = $("#pnl_password").val();

                let pnl_instansi = $("#pnl_instansi_id").val();
                let pnl_nip = $("#pnl_nip").val();
                let pnl_jabatan = $("#pnl_jabatan_id").val();
                let pnl_pangkat = $("#pnl_pangkat").val();
                let pnl_alamat = $("#pnl_alamat").val();
                let pnl_ktp = $("#pnl_ktp").val();
                let pnl_photo = $('#pnl_photo')[0].files;
                let pnl_biodata = $("#pnl_biodata").val();

                let pnl = new FormData();
                pnl.append('name', pnl_name);
                pnl.append('email', pnl_email);
                pnl.append('password', pnl_password);

                pnl.append('instansi_id', pnl_instansi);
                pnl.append('nip', pnl_nip);
                pnl.append('jabatan_id', pnl_jabatan);
                pnl.append('pangkat', pnl_pangkat);
                pnl.append('alamat', pnl_alamat);
                pnl.append('no_ktp', pnl_ktp);
                pnl.append('photo', pnl_photo[0]);
                pnl.append('biodata', pnl_biodata);


                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.simpanpegawai')}}",
                    data: pnl,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil di simpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                        });

                        $('#mdl-pnl').modal('hide');

                        $('#mdl-pnl').on('hidden.bs.modal', function () {
                            $(this).find('form')[0].reset(); // reset the form fields
                        });

                    }
                });


            });
        });
    </script>
    @endpush


@endsection


