<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale; 
use App\ProductSale; 

class ProductSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sale_id)
    {

        $sale = Sale::find($sale_id); 
        $products_sales = ProductSale::where('sale_id', '$sale->id')->get();
        return view('products_sales.index', compact('products_sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sale_id)
    {
        $sales = Sale::orderBy('id', 'ASC')-> pluck('id', 'user_id');
        $products =Product::orderBy('name', 'ASC')->pluck('name', 'id'); 
         return view('products_sales.create', compact('sales', 'products')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($sale_id, Request $request)
    {

        $request->validate([
            'sale_id' => 'required', 
            'product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required'
        ]); 


   
        $product_sale = ProductSale::create($request->all());
          dd($request->all()); 
        return redirect('sales/$product_sale->id/product_sales');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sale_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sale_id, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($sale_id, Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sale_id, $id)
    {
        //
    }
}
