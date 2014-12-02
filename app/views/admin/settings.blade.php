@extends('layout.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Settings</h1>
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
        {{ Form::model($settings, ['url'=>'admin/settings', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true]) }}
            <div class="row">
                <div class="col-md-6">
                    <h2>Application's settings</h2>
                        
                    <div class="form-group">
                        {{ Form::label('app_name', 'Name', ['class'=>'col-sm-2 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('app_name', null, ['class'=>'form-control']) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('main_logo', 'Main Logo', ['class'=>'col-sm-2 control-label']) }}
                        <div class="col-sm-7">
                            <div class="fileUpload">
                                {{ Form::file('main_logo', ['class'=>'upload']) }}
                                <img src="{{ $settings->main_logo }}" alt="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('favicon', 'Favicon', ['class'=>'col-sm-2 control-label']) }}
                        <div class="col-sm-4">
                            <div class="fileUpload">
                                {{ Form::file('favicon', ['class'=>'upload']) }}
                                <img src="{{ $settings->favicon }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h2>Company's settings</h2>

                    <div class="form-group">
                        {{ Form::label('company_name', 'Company Name', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_name', null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('company_street_address', 'Street Address', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_street_address', null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('company_zip_code', 'Zip Code', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_zip_code', null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('company_city', 'City', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_city', null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('company_country', 'Country', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_country', null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('company_phone_number', 'Phone Number', ['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-7">
                            {{ Form::text('company_phone_number', null, ['class'=>'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-floppy-o"></i> Save</button>
                    </div>
                </div>
            </div>

            
        {{ Form::close() }}
    </div>
</div>

@stop