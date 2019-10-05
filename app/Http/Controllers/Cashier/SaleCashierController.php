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

        $request->validate([
            'user_id' => 'required', 
            'client_id' => 'required', 
            'description' => 'required'
        ]);


        $request['total_amount'] = 0; 

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
