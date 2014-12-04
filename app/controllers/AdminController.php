<?php

class AdminController extends \BaseController {

	public function index()
	{
		return View::make('admin.index');
	}

	public function getSettings()
	{
		$settings = Setting::first();
		return View::make('admin.settings')
			->with('settings', $settings);
	}

	public function updateSettings()
	{
		$validator = Validator::make($data = Input::all(), Setting::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
		
		$settings = Setting::first();
		if (Input::hasFile('main_logo'))
		{
			$file               = Input::file('main_logo');
			$destinationPath    = public_path().'/uploads/';
			$main_logo_filename = str_random(6) . '_' . $file->getClientOriginalName();
			$uploadSuccess      = $file->move($destinationPath, $main_logo_filename);
			$settings->main_logo = '/uploads/'.$main_logo_filename;
		}
		if (Input::hasFile('favicon'))
		{
			$file               = Input::file('favicon');
			$destinationPath    = public_path().'/uploads/';
			$favicon_filename = str_random(6) . '_' . $file->getClientOriginalName();
			$uploadSuccess      = $file->move($destinationPath, $favicon_filename);
			$settings->favicon = '/uploads/'.$favicon_filename;
		}
		$settings->app_name = Input::get('app_name');
		$settings->company_name = Input::get('company_name');
		$settings->company_street_address = Input::get('company_street_address');
		$settings->company_zip_code = Input::get('company_zip_code');
		$settings->company_city = Input::get('company_city');
		$settings->company_country = Input::get('company_country');
		$settings->company_phone_number = Input::get('company_phone_number');
		$settings->save();

		return Redirect::back()->withFlashMessage('Settings Updated !');
	}

	public function getProfile()
	{
		return View::make('admin.profile');
	}

	public function updateProfile()
	{
		$validator = Validator::make($data = Input::all(), User::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
		
		Auth::user()->username = Input::get('username');
		Auth::user()->password = Hash::make(Input::get('password'));
		Auth::user()->save();

		return Redirect::back()->withFlashMessage('Settings Updated !');
	}

	public function storeInvoice()
	{
		$invoice = new Invoice;
		$invoice->category_id = Input::get('category_id');
		$invoice->title = Input::get('title');
		$invoice->slug = Str::slug(Input::get('title'));
		$invoice->save();
		return $invoice;
	}

	public function storeCategory()
	{
		$category = new Category;
		$category->name = Input::get('name');
		$category->save();
		return $category;
	}

	public function editInvoice($id)
	{
		$invoice = Invoice::find($id);
		$categories = Category::lists('name', 'id');
		return View::make('admin.invoice.edit')
			->with('invoice', $invoice)
			->with('categories', $categories);
	}

	public function updateInvoice($id)
	{
		$validator = Validator::make($data = Input::all(), Invoice::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$invoice = Invoice::find($id);
		if (Input::hasFile('image'))
		{
			$file            = Input::file('image');
			$destinationPath = public_path().'/uploads/';
			$image_filename  = str_random(6) . '_' . $file->getClientOriginalName();
			$uploadSuccess   = $file->move($destinationPath, $image_filename);
			$invoice->image = '/uploads/'.$image_filename;
		}
		$invoice->category_id = Input::get('category_id');
		$invoice->title = Input::get('title');
		$invoice->save();
		return Redirect::back()->withFlashMessage('Invoice Updated !');
	}

	public function getInvoiceOptions($id)
	{
		return InvoiceOption::where('invoice_id', $id)->orderBy('weight')->get();
	}
	public function storeInvoiceOptions($id)
	{
		$option = new InvoiceOption;
		$option->invoice_id = $id;
		$option->title = Input::get('title');
		$option->type = Input::get('type');
		// $option->option_group = Input::get('option_group');
		$option->price = Input::get('price');
		$option->save();

		return $option;
	}
	public function updateInvoiceOption()
	{
		$option = InvoiceOption::find(Input::get('id'));
		$option->title = Input::get('title');
		$option->save();

		return $option;
	}

	public function updateOptionWeight()
	{
		$option = InvoiceOption::find(Input::get('id'));
		$option->weight = Input::get('weight');
		$option->save();

		return $option;
	}

	public function deleteOption()
	{
		$option = InvoiceOption::find(Input::get('id'));
		$option->delete();
	}

}