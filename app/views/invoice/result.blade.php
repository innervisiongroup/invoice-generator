@extends('layout.master')

@section('styles')
<style>
    form{
        margin-top: 25px;
    }
    img{
        max-width: 100%;
    }
    .well{
        min-height: 210px;
    }
    .btn-primary{
        margin-top: 50px;
    }
    footer{
        display: none;
    }
</style>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{ Form::open(['route'=>'generate']) }}
            {{ Form::hidden('invoice_id', $invoice->id) }}

            <div class="row">
                <div class="col-xs-4">
                    <img src="{{ $invoice->image }}" alt="">
                </div>
                <div class="col-xs-4 col-xs-offset-4">
                    {{ Form::label('date', 'Date :') }}
                    <div>{{ $input['date'] }}</div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $invoice->title }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 col-xs-6">
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
                                <div class="form-inline">Conseiller : {{ $input['conseiller'] }}</div>
                                <div class="form-inline">Tel du Conseiller : {{ $input['conseiller_tel'] }}</div>
                                <div class="form-inline">Email du Conseiller : {{ $input['conseiller_email'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-xs-6 col-md-offset-2">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">Nom de l'entreprise : {{ $input['company_name'] }}</div>
                                <div class="form-inline">Nom / Prénom : {{ $input['name'] }}</div>
                                <div class="form-inline">Adresse : {{ $input['address'] }}</div>
                                <div class="form-inline">Tel. : {{ $input['tel'] }}</div>
                                <div class="form-inline">Email : {{ $input['email'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($input['radio']))
                <table class="table table-striped table-bordered">
                    @foreach ($input['radio'] as $option)
                        <tr>
                            <td>{{ $option }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

            @if (isset($input['checkbox']))
                <table class="table table-striped table-bordered">
                    @foreach ($input['checkbox'] as $option)
                        <tr>
                            <td>{{ $option }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif

        {{ Form::close() }}
    </div>
</div>

@stop