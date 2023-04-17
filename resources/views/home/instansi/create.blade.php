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
                                            <h5 class="title">Tambah Instansi</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    {!! Form::open(['route' => 'instansi.store', 'method' => 'POST', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Nama Instansi:</strong>
                                                {!! Form::text('nama', null, ['placeholder' => 'nama instansi', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Alamat Instansi:</strong>
                                                <textarea name="alamat" id="alamat" cols="4" rows="3" class="form-control"></textarea>
                                                {{-- {!! Form::textarea('alamat', null, [
                                                    'id' => 'alamat',
                                                    'rows' => 3,
                                                    'cols' => 40,
                                                    'style' => 'resize:none',
                                                    'class' => 'form-control',
                                                ]) !!} --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Logo :</strong>
                                                {!! Form::file('logo', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong> Nomor Telephone :</strong>
                                                {!! Form::text('telp', null, ['placeholder' => 'nama instansi', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <strong> Email :</strong>
                                                {!! Form::text('email', null, ['placeholder' => 'nama instansi', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <strong> Keterangan :</strong>
                                                <textarea name="keterangan" id="keterangan" cols="4" rows="3" class="form-control"></textarea>
                                                {{-- {!! Form::textarea('keterangan', null, [
                                                    'id' => 'keterangan',
                                                    'rows' => 3,
                                                    'cols' => 40,
                                                    'style' => 'resize:none',
                                                    'class' => 'form-control',
                                                ]) !!} --}}
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

    @push('scripts')
        <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    @endpush

    @push('body-scripts')
        <script>
            CKEDITOR.replace('keterangan');
        </script>
    @endpush
@endsection
