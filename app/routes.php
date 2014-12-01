<?php

Route::get('/', ['as' => 'home', 'uses' => 'InvoiceController@index']);