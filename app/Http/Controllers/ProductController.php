<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product; 
use App\Category; 
use App\Helper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name','ASC')->get(); 
        return view('products.index', compact('products')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->pluck('name','id'); 
        return view('products.create', compact('categories')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               //dd($request->all());
        $request->validate([
            'name'=>'required',
            'category_id' => 'required',
            'description'=>'required',
            'quantity'=>'required',
            'prize'=>'required', 
            'file' => 'image',  //tiene que ser imagen 
        ]);

        //$key = Helper::getToken();  PRUEBAS
        //dd($key);     PRUEBAS

        $request['password'] = bcrypt($request->password);
        //Generar usuario 
        $product = Product::create($request->all()); 

        // Verificar imagen en el request
        if($request->file){
            $name = Helper::saveImage($request->file, 'products', $product->id);

            $product->picture=$name; 
            $product->save();  

        }

        return redirect('products'); 
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
        //
    }
}
