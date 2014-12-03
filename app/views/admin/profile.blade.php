@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Profile</h1>
    </div>
</div>

@if ($errors->has())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@if (Session::has('flash_message'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        {{ Form::model(Auth::user(), ['url'=>'admin/profile', 'method' => 'post', 'class'=>'form-horizontal']) }}
            <div class="form-group">
                {{ Form::label('username', 'Username', ['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::text('username', null, ['class'=>'form-control']) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('password', 'Password', ['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::password('password', ['class'=>'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('password_confirmation', 'Password Confirmation', ['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-7">
                    {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>

@stop