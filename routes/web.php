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
Route::get('ck-vendor/subscription/{subId}', 'Api\v1\vendor\AddFoodService@singleSubView');
Route::get('/add-product', 'Api\v1\vendor\Product@addProductView');
Route::get('/update-product/{productID}', 'Api\v1\vendor\Product@updateProductView');
Route::post('/update-product-info/', 'Api\v1\vendor\Product@updateProductInfo');
Route::get('getProductByVendorId/{providerId}', 'Api\v1\vendor\Product@getProductByVendorId');
Route::get('getSubsProductById/{providerId}', 'Api\v1\vendor\Product@getSubsProductById');
Route::get('getAllSubByVendorId/{providerId}', 'Api\v1\vendor\AddFoodService@getAllSubByVendorId');
Route::get('getSingleProductById/{productId}', 'Api\v1\vendor\Product@getSingleProductById');
Route::post('/upload-product', 'Api\v1\vendor\Product@onProductSubmit');
Route::post('/upload-tiffin', 'Api\v1\vendor\Product@onTiffinProductSubmit');
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
Route::get('getOrderByVendorId/{id}','Api\v1\vendor\AddFoodService@getOrderByVendorId');

Route::get('vendors', 'Api\v1\vendor\AddFoodService@viewVendors');
Route::get('getVendors', 'Api\v1\vendor\AddFoodService@getVendors');
Route::get('getOtherVendors', 'Api\v1\vendor\AddFoodService@getOtherVendors');
Route::get('getVendorById/{id}', 'Api\v1\vendor\AddFoodService@getVendorById');
Route::get('getVendorByIdWithFeed/{id}', 'Api\v1\vendor\AddFoodService@getVendorByIdWithFeed');
Route::get('getUserSubscriptionById/{id}', 'Api\v1\Auth\Users@getUserSubscriptionById');
Route::get('getSingleSubscriptionById/{userId}/{subId}', 'Api\v1\Auth\Users@getSingleSubscriptionById');
Route::post('add-rating','Api\v1\vendor\AddFoodService@addVendorRating');

// web pages front-end
Route::get('services', 'Api\v1\vendor\AddFoodService@viewVendorsOnFront')->name('service');
Route::get('vendor/{id}', 'Api\v1\vendor\AddFoodService@viewSingleVendorsOnFront');

Route::post('test-upload', 'Api\v1\vendor\AddFoodService@testUpload');
Route::get('paytest/{vendorID}/{userID}/{productID}', 'Api\v1\vendor\AddFoodService@payment')->middleware('auth');

Route::get('order-detail/{orderID}/', 'Api\v1\vendor\AddFoodService@orderDetail')->middleware('auth');
Route::get('order-confirm', 'Api\v1\vendor\AddFoodService@orderConfirm')->middleware('auth');
Route::get('fetch-payment/{paymentID}', 'Api\v1\vendor\AddFoodService@fetchPayment')->middleware('auth');

Route::get('account/{slug}/{subId?}', 'Api\v1\Auth\Users@userAccount')
    ->middleware('auth')->name('account');

Route::get('ck-vendor/{slug}/{unique?}', 'Api\v1\vendor\AddFoodService@vendors')
    ->middleware('auth')->name('vendor');


Route::get('user/{id}', 'Api\v1\Auth\Users@getUserById')->middleware('auth');

Route::get('searchVendor/{vendorLike}', 'Api\v1\vendor\AddFoodService@searchVendor');

Route::get('vendor/getVendorById/{id}', 'Api\v1\vendor\AddFoodService@getVendorProfileById');

