@extends('layouts.app-master')

@section('content')
    @auth
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">
                                        <span class="preview-title-lg overline-title"> ini user show </span>
                                        <div class="row">

                                            <div class="col-lg-12 margin-tb">

                                                <div class="pull-left">

                                                    <h2> Show User</h2>

                                                </div>

                                                <div class="pull-right">

                                                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                <div class="form-group">

                                                    <strong>Name:</strong>


                                                    {{ $user->name }}

                                                </div>

                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                <div class="form-group">

                                                    <strong>Email:</strong>

                                                    {{ $user->email }}
                                                </div>

                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                <div class="form-group">

                                                    <strong>Roles:</strong>

                                                    @if (!empty($user->getRoleNames()))
                                                        @foreach ($user->getRoleNames() as $v)
                                                            <label class="badge bg-success">{{ $v }}</label>
                                                        @endforeach
                                                    @endif

                                                </div>

                                            </div>

                                        </div>
                                    </div>
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
@endsection
