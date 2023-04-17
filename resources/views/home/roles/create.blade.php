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
                                <span class="preview-title-lg overline-title"> ini roles create</span>
                                <div class="row">

                                    <div class="col-lg-12 margin-tb">

                                        <div class="pull-left">

                                            <h2>Create New Role</h2>

                                        </div>

                                        <div class="pull-right">

                                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>

                                        </div>

                                    </div>

                                </div>


                                @if (count($errors) > 0)

                                    <div class="alert alert-danger">

                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                                        <ul>

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                        </ul>

                                    </div>

                                @endif


                                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <div class="form-group">

                                            <strong>Name:</strong>

                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <div class="form-group">

                                            <strong>Permission:</strong>

                                            <br/>

                                            @foreach($permission as $value)

                                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}

                                                {{ $value->name }}</label>

                                            <br/>

                                            @endforeach

                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                                        <button type="submit" class="btn btn-primary">Submit</button>

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
</div>
@endauth

@guest
    <h1>Homepage</h1>
    <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
@endguest

@endsection
