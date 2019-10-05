<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Sale;
use App\Client; 
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

        $sales = Sale::where('user_id', $user->id)->get();  
        return view('cashier.sales.index', compact('sales', 'user', 'clients')); 


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
            'description' => 'required',
        ]);

        
        // $client = Client::find($request->ci); // solo colocar llave primaria,  ********
        // 
        // $sales = Sale::where('user_id', $user->id)->orderBy('name', 'ASC');

        // $client = Client::where('user_id', $user->id)->where('id', $request->client_id)->orderBy('name', 'ASC')->first();

        // $client = Client::where('user_id', $user->id)->orderBy('name', 'ASC')->first();

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
            
            $request['client_id'] =  $client->id;
            $sale = Sale::create($request->all());
        
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
}
