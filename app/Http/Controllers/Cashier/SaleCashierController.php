<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Sale;
use App\Client; 
use App\ProductSale;
use Illuminate\Support\Facades\Auth;

class SaleCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();   

        $clients = Client::where('user_id', $user->id)->orderBy('name', 'ASC') -> pluck('name', 'id');
        /*
        $products = Product::orderBy('name', 'ASC')->pluck('name', 'id');
        */

        $products = Product::orderBy('name', 'ASC')->get();
        $sales = Sale::where('user_id', $user->id)->get();  

        return view('cashier.sales.index', compact('sales', 'user', 'clients', 'products')); 


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /*
        $user = Auth::user(); 
        $clients = Client::where('user_id', $user->id)->orderBy('name', 'ASC')->get();
        return view('cashier.sales.create', compact('user', 'clients')); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $user = Auth::user();  

        $request->validate([
            'name' => 'required',
            'ci' => 'required',
            'products_id' => 'required',
            'quantity' => 'required',
            'description' => 'required',

        ]);


        $client = Client::where('ci', $request->ci)->first(); 

        $request['user_id'] = $user->id; 

        $request['total_amount'] = 0;

        if($client){

            $client->fill($request->all());
            $client->save();   
           
        }
        else {
            $client = Client::create($request->all()); 
        }
            ////
            $request['client_id'] =  $client->id;

            $sale = Sale::create($request->all());

            /////
            $request['sale_id'] = $sale->id;

            foreach($request->products_id as $product_id){

                $product = Product::find($product_id);

                $request['product_id'] = $product_id;

                $request['amount'] = $request->quantity * $product->prize; 

                $sale->total_amount = $sale->total_amount + $request->amount;

                $product_sale = ProductSale::create($request->all());
            }

                $sale->save();
                return redirect('/cashier/sales');
    
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
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);

        if($sale)
        {
            $product_sale = ProductSale::where('sale_id', $sale->id)->delete();
            $sale->delete();
        }

        return redirect('/cashier/sales');
    }

    public function get_client($ci)
    {

        $client = Client::where('ci', $ci)->first();

        if($client){
            $name=$client->name; 
        }
        else
        {
            $name="";
        }
        return $name; 
    
    }
}
