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
                                            <h5 class="title">Tambah Basan</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    {!! Form::open(['route' => 'admin.simpanBasan', 'method' => 'POST', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">

                                                <input type="hidden" name="penelitian_id" value="{{ $id }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nomor Basan :</strong>
                                                <input type="text" name="no" class="form-control" value="{{$basan->no}}">
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <div class="form-group">
                                                <strong> Nama Basan :</strong>
                                                <input type="text" name="nama" class="form-control" value="{{$basan->nama}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-8 col-sm-8 col-md-8">
                                            <div class="form-group">
                                                <strong>Photo</strong>
                                                <input type="file" name="photo" class="form-control" value="{{$basan->photo}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Jumlah</strong>
                                                <input type="text" name="jumlah" class="form-control" value="{{ $basan->jumlah }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Golongan</strong>
                                                <input type="text" name="golongan" class="form-control" value="{{ $basan->golongan }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Kondisi</strong>
                                                <input type="text" name="kondisi" class="form-control" value="{{ $basan->kondisi }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Bentuk</strong>
                                                <input type="text" name="bentuk" class="form-control" value="{{ $basan->bentuk }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Berat</strong>
                                                <input type="text" name="berat" class="form-control" value="{{ $basan->berat }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Tinggi</strong>
                                                <input type="text" name="tinggi" class="form-control" value="{{ $basan->tinggi }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Ciri</strong>
                                                <input type="text" name="ciri" class="form-control" value="{{ $basan->ciri }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Sifat</strong>
                                                <input type="text" name="sifat" class="form-control" value="{{ $basan->sifat }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong>Segel</strong>
                                                <select name="keadaan" id="" class="form-select">
                                                    <option {{ $basan->keadaan == "tidak" ? "selected" : "" }} value="tidak">tidak</option>
                                                    <option {{ $basan->keadaan == "ya" ? "selected" : "" }} value="ya">ya</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong>Keterangan</strong>
                                                <textarea name="keterangan" class="form-control" id="" cols="30" rows="10">{{ $basan->keterangan }}</textarea>
                                            </div>
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

    @endauth

    @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
    @endguest

    @push('body-scripts')

    @endpush


@endsection


