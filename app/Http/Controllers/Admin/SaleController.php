<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Sale; 
use App\User; 
use App\ProductSale; 
use App\Client;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products_sales = ProductSale::orderBy('name', 'ASC')->get(); 

        $sales = Sale::orderBy('user_id', 'ASC')->get(); 

       //$total_update = Sale::where('id', $products_sales->sale_id)->get(); 

        return view('superadmin.sales.index', compact('sales')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::orderBy('name', 'ASC') -> pluck('name', 'id'); 
        $clients = Client::orderBy('name', 'ASC') -> pluck('name', 'id');
        return view('superadmin.sales.create', compact('users', 'clients')); 
    }

    /**
     * Store a newly created resource in storage.
     *s
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

        /*
        $client=Client::where('ci',$request->ci)->first(); 

        if($client){

            $client->fill($request->all());

            $client->save(); 
        }
        else{
             $client=Client::create($request->all());
        }
        

        $request['client_id']=$client->id;

        */

        $request['total_amount']= 0 ;  // Agregar elementos 

        $sale = Sale::create($request->all());
          
        return redirect('sales');
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
        $sale = Sale::find($id);
        $users = User::orderBy('name', 'ASC') -> pluck('name', 'id'); 
        $clients = Client::orderBy('name', 'ASC') -> pluck('name', 'id');
        return view('superadmin.sales.edit', compact('sale', 'users','clients'));

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
        $sale = Sale::find($id); 
        $request->validate([
            'user_id' => 'required', 
            'description' => 'required',
        ]); 

        $sale->fill($request->all());
        $sale->save(); 
        return redirect('sales');
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

        if($sale){
              $product_sale = ProductSale::where('sale_id', $sale->id)->delete();
              $sale->delete();
        }
      
        return redirect('sales');  //redirigir a ruta users
    }
}
