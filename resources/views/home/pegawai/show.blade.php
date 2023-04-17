@extends('layouts.app-master')

@section('content')
    <style>
        .avatar {
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            border-radius: 0.75rem;
            height: 48px;
            width: 48px;
            transition: all .2s ease-in-out;
        }

        .avatar-xl {
            width: 74px !important;
            height: 74px !important;
        }

        .my-auto {
            margin-top: auto !important;
            margin-bottom: auto !important;
        }

        .dark {
            color: #344767;
        }

        hr.horizontal {
            background-color: transparent;
        }
    </style>
    @auth
        <div class="container-fluid py-4">
            <div class="card shadow-lg mx-4 card-profile-bottom">
                <div class="card-body p-3">
                    <div class="row gx-2">
                        <div class="col-auto">
                            <div class="avatar avatar-xl postion-relative">
                                <img src="{{ asset('images/' . $data->photo) }}" class="w-100 border-radius-lg shadow-sm" alt="">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ $data->usrName }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ $data->jabatan}} - {{ $data->pangkat }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="text-input-username" class="form-control-label"><strong>Nama</strong></label>
                                    <input type="text" class="form-control" value="{{ $data->usrName }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="text-input-email" class="form-control-label"><strong>Email</strong></label>
                                    <input type="email" class="form-control" value="{{ $data->usrEmail }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row  mt-2">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="text-input-nik" class="form-control-label"><strong>NIK</strong></label>
                                    <input type="text" class="form-control" value="{{ $data->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="text-input-no-ktp" class="form-control-label"><strong>No KTP</strong></label>
                                    <input type="text" class="form-control" value="{{ $data->no_ktp }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark mt-4">
                        <p class="text-uppercase text-sm">Instansi Information</p>
                        <div class="row">
                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                <div class="postion-relative">
                                    <img src="{{ asset('images/' . $data->logo) }}" class="w-100 border-radius-lg shadow-sm" alt="">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="text-input-instansi" class="form-control-label"><strong>Instansi</strong></label>
                                        <input type="instansi" class="form-control" value="{{ $data->insName }}" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="text-input-email" class="form-control-label"><strong>Email</strong></label>
                                        <input type="email" class="form-control" value="{{ $data->insEmail }}" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="text-input-telp" class="form-control-label"><strong>Telp</strong></label>
                                        <input type="text" class="form-control" value="{{ $data->telp }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 form-group">
                                        <label for="text-input-alamat" class="form-control-label"><strong>Alamat</strong></label>
                                        <input type="text" class="form-control" value="{{ $data->insAlamat }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>



    @endauth
@endsection
