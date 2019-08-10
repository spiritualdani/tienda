<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    //
    protected $table = 'sales'; 

    protected $fillable = [
    	'total_amount',
    	'description',
    	'user_id',
    ]; 

    public function user() 
    {
    	return $this->belongsTo('App\User');

    }

    public function products_sales()
    {
        return $this->hasMany('App\ProductSale'); 
    }
}
