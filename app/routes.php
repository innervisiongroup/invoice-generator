<?php

Route::get('/', ['as' => 'home', 'uses' => 'InvoiceController@index']);

Route::group(array('prefix' => 'admin', 'before' => 'auth.basic'), function()
{
    Route::get('/', 'AdminController@index');
    Route::get('index', 'AdminController@index');
    
    Route::get('settings', 'AdminController@getSettings');
    Route::post('settings', 'AdminController@updateSettings');

    Route::get('profile', 'AdminController@getProfile');
    Route::post('profile', 'AdminController@updateProfile');

    Route::get('invoice/{id}', 'AdminController@editInvoice');
    Route::post('invoice/{id}', 'AdminController@updateInvoice');
    
    Route::group(array('prefix' => 'api'), function()
    {
        Route::get('invoice', function() {
            return Invoice::with('category')->get();
        });
        
        Route::get('invoice/{id}/options', 'AdminController@getInvoiceOptions');
        Route::post('invoice/{id}/options', 'AdminController@storeInvoiceOptions');
        
        Route::get('category', function() {
            return Category::all();
        });
        
        Route::post('invoice', 'AdminController@storeInvoice');
        Route::post('invoice/delete', 'AdminController@deleteInvoice');
        Route::post('category', 'AdminController@storeCategory');
        Route::post('category/delete', 'CategoryController@delete');
    });
});