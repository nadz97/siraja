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
                                    {!! Form::open(['route' => 'admin.simpanRekomendasi', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <input type="hidden" value="{{ $id }}" name="id">
                                            <div class="form-group">
                                                <strong> Rekomendasi:</strong>
                                                {!! Form::text('rekomendasi', null, ['placeholder' => 'Rekomendasi', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
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
