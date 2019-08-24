<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale; 
use App\User; 
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('total_amount', 'ASC')->get(); 
        return view('sales.index', compact('sales')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name', 'ASC') -> pluck('name', 'id'); 
        return view('sales.create', compact('users')); 
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
            'description' => 'required',
        ]); 


        $request['total_amount']= 0 ;  // Agregar elementos 
       
        $sale = Sale::create($request->all());
          dd($request->all()); 
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
        return view('sales.edit', compact('sale', 'users'));

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
              $sale->delete();
        }
      
        return redirect('sales');  //redirigir a ruta users
    }
}
