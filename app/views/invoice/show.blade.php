@extends('layout.master')

@section('styles')
<style>
    form{
        margin-top: 25px;
    }
    img{
        max-width: 100%;
    }
    .form-inline{
        margin-bottom: 5px;
    }
    .well{
        min-height: 257px;
    }
    .btn-primary{
        margin-top: 50px;
    }
</style>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route'=>'generate']) }}
            {{ Form::hidden('invoice_id', $invoice->id) }}

            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $invoice->image ?: Setting::first()->main_logo }}" alt="">
                </div>
                <div class="col-md-4 col-md-offset-4">
                    {{ Form::label('date', 'Date :') }}
                    {{ Form::input('date', 'date', date('Y-m-d'), ['class'=>'form-control']) }}
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $invoice->title }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <strong>Emetteur</strong>
                                </div>
                                <div>{{ $setting->company_name }}</div>
                                <div>{{ $setting->company_street_address }}</div>
                                <div>{{ $setting->company_zip_code }}, {{ $setting->company_city }}</div>
                                <div>Tel.: {{ $setting->company_phone_number }}</div>
                                <div class="form-inline">Conseiller : {{ Form::text('conseiller', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Tel du Conseiller : {{ Form::text('conseiller_tel', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Email du Conseiller : {{ Form::email('conseiller_email', null, ['class'=>'form-control']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-2">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">Nom de l'entreprise : {{ Form::text('company_name', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Nom / Prénom : {{ Form::text('name', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Adresse : {{ Form::text('address', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Tel. : {{ Form::text('tel', null, ['class'=>'form-control']) }}</div>
                                <div class="form-inline">Email : {{ Form::email('email', null, ['class'=>'form-control']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($options as $option)
                <div class="row">
                    <div class="col-md-3">
                        @if ($option->type == 'radio')
                            <div class="radio">
                                <label>
                                    <input type="radio" name="radio[]" value="{{ $option->title }}">
                                    {{ $option->title }}
                                </label>
                            </div>
                        @elseif ($option->type == 'checkbox')
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="checkbox[]" value="{{ $option->title }}">
                                    {{ $option->title }}
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach


            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    {{ Form::submit('Génerer !', ['class'=>'btn btn-primary btn-block btn-lg']) }}
                </div>
            </div>

        {{ Form::close() }}
    </div>
</div>

@stop