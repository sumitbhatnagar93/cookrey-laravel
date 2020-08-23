<?php

use Illuminate\Support\Facades\Route;

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


/**
 * Product Related Routes
 */
Route::get('/add-product', 'Api\v1\Product@addProductView');
Route::get('getProductById/{providerId}', 'Api\v1\Product@getProductById');
Route::post('/upload-product', 'Api\v1\Product@onProductSubmit');
Route::post('byApp', 'HomeController@registerByApp');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Pages
Route::get('add-service', 'Api\v1\AddFoodService@addServiceView');
Route::post('add-business', 'Api\v1\AddFoodService@addServiceView');

Route::get('getVendors', 'Api\v1\AddFoodService@getVendors');
Route::get('getVendorById/{id}', 'Api\v1\AddFoodService@getVendorById');
