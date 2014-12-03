@extends('layout.admin')

@section('styles')
    <style>
        input[name=title]{
            border: 0px;
            outline: none;
            width: 100%;
        }
    </style>
@stop

@section('content')

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

{{ Form::model($invoice, ['url'=>'admin/invoice/'.$invoice->id, 'files'=>true]) }}
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ Form::text('title', null, ['placeholder'=>'Title']) }}
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            
        </div>
        <div class="col-lg-3">
            <div class="well">
                <div class="form-group">
                    {{ Form::label('image', 'Image') }}
                    <div class="fileUpload">
                        {{ Form::file('image', ['class'=>'upload']) }}
                        <img src="{{ $invoice->image }}" alt="">
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('category_id', 'Category') }}
                    {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('scripts')

@stop