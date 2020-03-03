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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/items', 'ProductList@index')->name('productsList');
Route::get('/items/{id}', 'ProductController@show')->name('showProduct');
Route::post('/items/add', 'ProductController@store')->name('addItem');

Route::get('/sell', 'UserPanelController@sellView')->name('sellItem');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/add', 'CartController@addToCart')->name('addToCart');
Route::post('/cart/delete', 'CartController@destroy')->name('deleteFromCart');

Route::post('/cart/checkout', 'CheckoutController@checkout')->name('cartCheckout');

Route::middleware('auth')->group(function () {
    Route::get('user/profile', function () {
        return view('welcome');
    })->name('user.profile');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
