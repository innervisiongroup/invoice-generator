<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Invoice extends \Eloquent implements SluggableInterface {
	protected $fillable = ['category_id', 'title', 'image'];

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    public static $rules = [
        'category_id' => 'required|integer',
        'title'       => 'required|min:2',
        'image'       => 'image',
    ];

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function options()
    {
        return $this->hasMany('InvoiceOption');
    }
}