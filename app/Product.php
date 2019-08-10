<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //
    protected $table='products'; 

    protected $fillable=[
    	'name', 
    	'description',
    	'quantity',
    	'picture',
    	'prize',
  		'category_id'
    ];


    public function category()
    {
    	return $this->belongsTo('App\Category');

    }

    public function products_sales()
    {
        return $this->hasMany('App\ProductSale'); 
    }
}
