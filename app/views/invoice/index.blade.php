@extends('layout.master')

@section('content')

<div class="row">
    <div class="col-md-12 text-center">
        <h1>{{ Setting::first()->app_name }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Select an invoice template</h2>
        <div class="list-group">
            @foreach ($invoices as $invoice)
                <a href="{{ URL::to('invoice/'.$invoice->slug) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $invoice->title }}</h4>
                    <p class="list-group-item-text">Category: {{ $invoice->category->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>

@stop