<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	Route::resource('rols','RolController'); 
	Route::resource('users','UserController');
	Route::resource('categories', 'CategoryController'); 
	Route::resource('products', 'ProductController'); 
	Route::resource('sales', 'SaleController'); 
	Route::resource('sales.products_sales', 'ProductSaleController'); 
});