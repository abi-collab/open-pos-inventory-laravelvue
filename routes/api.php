<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list')->name("category.list");
    Route::post('product/upload', 'ProductController@upload');


    Route::apiResources([
        'user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
        'tag' => 'TagController',
        // 'invoice' => 'InvoiceController'
    ]);
});

Route::post('api/invoice', 'App\Http\Controllers\InvoiceController@store');
Route::get('invoice', 'App\Http\Controllers\InvoiceController@index');
Route::get('invoice3', 'App\Http\Controllers\CustomerController@index');
// Route::put('invoice/{serialnumber}', 'App\Http\Controllers\SerialController@update');

Route::get('dashboardAll', 'App\Http\Controllers\InvoiceController@getAll');
Route::get('dashboard', 'App\Http\Controllers\InvoiceController@getOrderSpecific');
Route::get('dashboardPurchaseDetails', 'App\Http\Controllers\InvoiceController@getPurchaseDetails');
Route::get('dashboard2', 'App\\Http\\Controllers\\API\V1\ProductController@index');
Route::get('dashboardCategories', 'App\\Http\\Controllers\\API\V1\CategoryController@list');


// Route::post('invoiceAddNewCustomer', 'App\Http\Controllers\CustomerController@store');
Route::post('customers', 'App\Http\Controllers\CustomerController@store');
Route::get('customers', 'App\Http\Controllers\CustomerController@index');
Route::put('customers/{id}', 'App\Http\Controllers\CustomerController@update');
Route::delete('customers/{id}', 'App\Http\Controllers\CustomerController@destroy');

Route::post('customersOrderx', 'App\Http\Controllers\InvoiceController@store');
Route::get('customersOrder', 'App\Http\Controllers\API\V1\ProductController@index');
Route::post('customerOrderProduct', 'App\Http\Controllers\API\V1\ProductController@orderproduct');

Route::put('updateProductQty', 'App\Http\Controllers\API\V1\ProductController@orderproduct');

Route::post('orderproduct', 'App\Http\Controllers\API\V1\ProductController@orderproduct');

Route::post('serialno', 'App\Http\Controllers\SerialController@save_serial');
Route::get('serialno', 'App\Http\Controllers\SerialController@index');
Route::put('serialno/{id}', 'App\Http\Controllers\SerialController@update');
Route::delete('serialno/{id}', 'App\Http\Controllers\SerialController@destroy');



Route::get('getProductsWithSerialNos', 'App\\Http\\Controllers\\API\V1\ProductController@getProductsWithSerialNos');

Route::get('productsWithSerialNo', 'App\Http\Controllers\SerialController@productsWithSerialNo');


Route::put('updateProductInvoice', 'App\\Http\\Controllers\\API\V1\ProductController@update');

Route::post('invoiceImgSave', 'App\Http\Controllers\invoiceimagesController@store');
Route::get('invoiceImgGet', 'App\Http\Controllers\invoiceimagesController@index');









