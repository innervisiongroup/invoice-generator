<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
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

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}