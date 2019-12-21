<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function front()
    {

         $products = Product::orderBy('name', 'ASC')->get();
        return view('welcome3', compact('products'));

    }
}
