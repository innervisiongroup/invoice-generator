<?php

class Invoice extends \Eloquent {
	protected $fillable = ['category_id', 'title', 'image'];

    public static $rules = [
        'category_id' => 'required',
        'title'       => 'required|min:2',
        'image'       => 'image|mimes',
    ];
}