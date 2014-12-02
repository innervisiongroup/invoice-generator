<?php

class Setting extends \Eloquent {
	protected $fillable = ['app_name', 'main_logo', 'favicon', 'company_name', 'company_street_address', 'company_zip_code', 'company_city', 'company_country', 'company_phone_number'];

    public static $rules = [
        'app_name' => 'required',
        'main_logo' => 'image',
        'favicon' => 'image',
        'company_name' => 'required',
        'company_street_address' => 'required',
        'company_zip_code' => 'required',
        'company_city' => 'required',
        'company_country' => 'required',
        'company_phone_number' => 'required',
    ];
}