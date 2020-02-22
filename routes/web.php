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

/*
Route::get('/', function () {


    //return view('welcome3');

});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@front');

Route::middleware(['auth', 'super'])->group(function () {
	Route::resource('rols','Admin\RolController'); 
	Route::resource('users','Admin\UserController');
	Route::resource('categories', 'Admin\CategoryController'); 
	Route::resource('products', 'Admin\ProductController'); 
	Route::resource('sales', 'Admin\SaleController'); 

	Route::get('sales/get_client/{ci}', 'Admin\SaleController@get_client');
	
	Route::resource('sales.products_sales', 'Admin\ProductSaleController'); 
	Route::resource('users.clients', 'Admin\UserClientController'); 
	Route::resource('reports', 'Admin\ReportController');
	Route::get('reports/query/{period_sub}/{user_id}', 'Admin\ReportController@query');


});

Route::middleware(['auth', 'cashier'])->prefix('cashier')->group(function () {
	Route::get('products','Cashier\ProductCashierController@index'); 
	Route::resource('sales','Cashier\SaleCashierController');
	Route::get('sales/get_client/{ci}', 'Cashier\SaleCashierController@get_client');
	Route::get('sales/{id}/bill','Cashier\SaleCashierController@bill');
	Route::resource('sales.sales_products', 'Cashier\SaleProductCashierController');
	Route::resource('sales_clients', 'Cashier\SaleClientCashierController');
});


