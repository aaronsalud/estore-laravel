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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::post('/cart/saveForLater/{id}', 'SaveForLaterController@store')->name('saveForLater.store');
Route::delete('/cart/saveForLater/{id}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');

Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
