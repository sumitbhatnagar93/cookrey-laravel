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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 * Product Related Routes
 */
Route::get('/add-product', 'Api\v1\vendor\Product@addProductView');
Route::get('/add-subscription-product', 'Api\v1\vendor\Product@addSubscriptionProductView');
Route::get('getProductById/{providerId}', 'Api\v1\vendor\Product@getProductById');
Route::get('getSubsProductById/{providerId}', 'Api\v1\vendor\Product@getSubsProductById');
Route::get('getSingleProductById/{productId}', 'Api\v1\vendor\Product@getSingleProductById');
Route::post('/upload-product', 'Api\v1\vendor\Product@onProductSubmit');
Route::post('byApp', 'HomeController@registerByApp');

Auth::routes();

Route::post('payment', 'Api\v1\payment\paymentController@paymentProcess');


// Pages
Route::get('add-service', 'Api\v1\vendor\AddFoodService@addServiceView');
Route::get('delete-service/{id}', 'Api\v1\vendor\AddFoodService@deleteVendorController');
Route::get('add-service/{id}', 'Api\v1\vendor\AddFoodService@updateVendorView');
Route::post('update-service', 'Api\v1\vendor\AddFoodService@updateVendorController');
Route::post('add-business', 'Api\v1\vendor\AddFoodService@addServiceView');
Route::post('addSubscription', 'Api\v1\vendor\AddFoodService@addSubscription');
Route::post('cancelSubsDate', 'Api\v1\vendor\AddFoodService@cancelSubsDate');

Route::post('addOrder', 'Api\v1\vendor\AddFoodService@createOrder');
Route::get('getOrderById/{id}','Api\v1\vendor\AddFoodService@getOrderById');
Route::get('getOrderByUserId/{id}','Api\v1\vendor\AddFoodService@getOrderByUserId');

Route::get('vendors', 'Api\v1\vendor\AddFoodService@viewVendors');
Route::get('getVendors', 'Api\v1\vendor\AddFoodService@getVendors');
Route::get('getOtherVendors', 'Api\v1\vendor\AddFoodService@getOtherVendors');
Route::get('getVendorById/{id}', 'Api\v1\vendor\AddFoodService@getVendorById');
Route::get('getUserSubscriptionById/{id}', 'Api\v1\Auth\Users@getUserSubscriptionById');
