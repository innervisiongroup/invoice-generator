<?php

Route::get('/', ['as' => 'home', 'uses' => 'InvoiceController@index']);

Route::group(array('prefix' => 'admin', 'before' => 'auth.basic'), function()
{
    Route::get('/', 'AdminController@index');
    Route::get('index', 'AdminController@index');
    Route::get('settings', 'AdminController@getSettings');
    Route::post('settings', 'AdminController@updateSettings');
});