<?php

class InvoiceController extends \BaseController {

	public function index()
	{
		$invoices = Invoice::all();
		return View::make('invoice.index')
			->with('invoices', $invoices);
	}

	public function show($slug)
	{
		$invoice = Invoice::where('slug', $slug)->first();
		$options = InvoiceOption::where('invoice_id', $invoice->id)->orderBy("weight")->get();
		$setting = Setting::first();
		return View::make('invoice.show')
			->with('options', $options)
			->with('setting', $setting)
			->with('invoice', $invoice);
	}

	public function result()
	{
		$invoice = Invoice::find(Input::get('invoice_id'));
		$setting = Setting::first();
		return View::make('invoice.result')
			->with('input', Input::all())
			->with('setting', $setting)
			->with('invoice', $invoice);
	}

}