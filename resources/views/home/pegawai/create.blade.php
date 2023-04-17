@extends('layouts.app-master')

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

                    <div class="nk-block">
                        <div class="car">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h5 class="title">Tambah Pegawai</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    {!! Form::open(['route' => 'pegawai.store', 'method' => 'POST', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Nama Pegawai:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'nama pegawai', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> NIK :</strong>
                                                {!! Form::text('nik', null, ['placeholder' => 'Nomor Induk Kependudukan', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Email :</strong>
                                                {!! Form::text('email', null, ['placeholder' => 'contoh@gmail.com', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Pasword :</strong>
                                                {!! Form::password('password', [ 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Nama Instansi:</strong>
                                                <select name="instansi_id" class="form-select">
                                                    @foreach ($instansi as $ins)
                                                        <option value="{{$ins->id}}">{{$ins->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Roles:</strong>
                                                <select name="roles" class="form-select">
                                                    @foreach ($roles as $rl)
                                                        <option value="{{$rl->id}}">{{$rl->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row mt-2">

                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Jabatan :</strong>
                                                <select name="jabatan" class="form-select">
                                                    @foreach ($jabatan as $jbt)
                                                        <option value="{{$jbt->id}}">{{$jbt->jabatan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> No KTP :</strong>
                                                {!! Form::text('no_ktp', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Pangkat :</strong>
                                                {!! Form::text('pangkat', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Photo :</strong>
                                                {!! Form::file('photo', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Alamat :</strong>
                                                <textarea name="alamat" id="alamat" cols="4" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Biodata :</strong>
                                                <textarea name="biodata" id="biodata" cols="4" rows="3" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
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

    {{-- @push('scripts')
        <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @endpush

    @push('body-scripts')
        <script>
            CKEDITOR.replace('alamat');
        </script>
    @endpush --}}
@endsection
