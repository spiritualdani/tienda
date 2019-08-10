<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    

    protected $table = 'products-sales'; 

    protected $fillable = [
    	'quantity', 
    	'amount',
    	'product_id',
    	'sale_id',
    ];


    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function sale()
    {
    	return $this->belongsTo('App\Sale'); 
    }
}
