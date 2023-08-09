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
Route::resource('sign', 'SignController');

Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index')->name('home.index');
    Route::get('count','HomeController@create')->name('count.index');
    Route::post('add-coupon','HomeController@store')->name('addcoupon');
    Route::resource('all-product', 'AllProController');
    Route::resource('detail', 'DetailController');
    Route::resource('cart', 'CartController');
    Route::resource('checkout', 'CheckOutController');
    Route::resource('wishlist', 'WishlistController');
    Route::resource('contact', 'ContactController');
});

Route::group(['prefix' => 'admin','namespace'=>'BackEnd'],function(){
    Route::resource('home-admin', 'HomeController');
    Route::resource('dashboard', 'DashController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('coupon', 'CouponController');
    Route::resource('account', 'AccountController');
    Route::resource('order', 'OrderController');
    Route::resource('slider', 'SliderController');
});
