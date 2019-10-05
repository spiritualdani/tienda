<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use App\ProductSale;
use App\Product; 
use Illuminate\Support\Facades\Auth;

class SaleProductCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sale_id)
    {

        $sale = Sale::find($sale_id); 

        $user = Auth::user();

        // $clients = Client::where('user_id', $user->id)->get(); 
    
        $products_sales = ProductSale::where('sale_id', $sale->id)->get();

        // $sales = Sale::orderBy('id', 'ASC')->pluck('id', 'user_id'); 

        return view('cashier.sales_products.index', compact('products_sales', 'sale', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sale_id)
    {
        $sale = Sale::find($sale_id);
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id');  

        return view('cashier.sales_products.create', compact('sale', 'products')); 

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
            'quantity' => 'required'
        ]);

        $product = Product::find($request->product_id); 
        $sale = Sale::find($sale_id);
        // $sale = Sale::find($request->sale_id);

        $request['amount'] = $request->quantity * $product->prize; 
        $sale->total_amount = $sale->total_amount + $request->amount; 

        $sale->save();

        $product_sale = ProductSale::create($request->all());

        return redirect('/cashier/sales/'.$product_sale->sale_id.'/sales_products');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        return view('cashier.sales_products.edit', compact('sale', 'product_sale', 'products')); 

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
        $request->validate([
            'sale_id' => 'required', 
            'product_id' => 'required', 
            'quantity' => 'required'

        ]);

        $product_sale = ProductSale::find($id);
        $product = Product::find($request->product_id);
        $sale = Sale::find($sale_id);

        $old_amount = $product_sale->amount; 
        $request['amount'] = $request->quantity * $product->prize; 
        $sale->total_amount = $sale->total_amount - $old_amount + $request->amount; 
        $sale->save();

        $product_sale->fill($request->all());
        $product_sale->save();
        return redirect('/cashier/sales/'.$product_sale->sale_id.'/sales_products');

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
        if($product_sale)
        {
            $sale = Sale::find($sale_id); 
            $sale->total_amount = $sale->total_amount - $product_sale->amount; 
            $sale->save();
            $product_sale->delete();
        }

        return redirect('/cashier/sales/'.$sale_id.'/sales_products');

    }
}
