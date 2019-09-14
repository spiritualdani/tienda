<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use App\Sale; 
use App\Product;
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
            
        //dd($sale->id);

        $products_sales = ProductSale::where('sale_id', $sale->id)->get();

        $sales = Sale::orderBy('id', 'ASC')->pluck('id', 'user_id'); 

        return view('superadmin.products_sales.index', compact('products_sales', 'sales', 'sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sale_id)
    {

        $sale = Sale::find($sale_id);
      
       //$sales = Sale::orderBy('id', 'ASC')->pluck('id', 'user_id'); 

       $products = Product::orderBy('name', 'ASC')->pluck('name', 'id'); 

    return view('superadmin.products_sales.create', compact('sale', 'products')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($sale_id, Request $request)
    {

        $product = Product::find($request->product_id); 
        $sale = Sale::find($request->sale_id); 
        //$products_sales = ProductSale::find($sale_id); 
        $request->validate([
            'sale_id' => 'required', 
            'product_id' => 'required',
            'quantity' => 'required',
         
        ]); 

         $request['amount'] = $request->quantity * $product->prize;
         $sale->total_amount = $sale->total_amount + $request->amount;

         $sale->save();

   
        $product_sale = ProductSale::create($request->all());

        return redirect('/sales/'.$product_sale->sale_id.'/products_sales');
      
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
        $sale = Sale::find($sale_id);
        $product_sale = ProductSale::find($id);

        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id'); 
        return view('superadmin.products_sales.edit', compact('product_sale', 'products',''));
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

        $product = Product::find($request->product_id); 
        $sale = Sale::find($request->sale_id); 
      
        $product_sale = ProductSale::find($id); 
        $request->validate([
            'sale_id' => 'required', 
            'product_id' => 'required',
            'quantity' => 'required',
       
        ]);
        //dd($product_sale->amount);
        $old_amount = $product_sale->amount; 

        $request['amount'] = $request->quantity * $product->prize;
       
        /**
        if($old_amount < $request->amount){
            $sale->total_amount = $sale->total_amount - $old_amount + $request->amount;
        }
        else 
            {
                $sale->total_amount = $sale->total_amount - $old_amount + $request->amount;
            }*/

        $sale->total_amount = $sale->total_amount - $old_amount + $request->amount;
    

        $sale->save();


        $product_sale->fill($request->all());
        $product_sale->save();
        return redirect('/sales/'.$product_sale->sale_id.'/products_sales'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sale_id, $id)
    {
        $product_sale = ProductSale::find($id); 

        if($product_sale){

            $sale=Sale::find($sale_id);


            $sale->total_amount=$sale->total_amount - $product_sale->amount; 
            $sale->save();
            $product_sale->delete();
        }

      
        return redirect('/sales/'.$product_sale->sale_id.'/products_sales');  //redirigir a ruta users
    }
}
