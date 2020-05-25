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

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/add', 'CartController@addToCart')->name('addToCart');
Route::post('/cart/delete', 'CartController@destroy')->name('deleteFromCart');
//Route::post('/cart/checkout', 'CheckoutController@checkout')->name('cartCheckout');
Route::post('/cart/checkout', 'Payments\PaymentController@checkout')->name('cartCheckout');

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'user'], function (){
        Route::get('sell', 'UserPanelController@sell')->name('user.sell');
        Route::get('profile', 'UserPanelController@profile')->name('user.profile');
        Route::get('items', 'UserPanelController@items')->name('user.items');
        Route::get('favourites', 'UserPanelController@favourites')->name('user.fav');
        Route::get('settings', 'UserPanelController@settings')->name('user.settings');
        Route::get('messages', 'UserPanelController@messages')->name('user.messages');

        Route::resource('saved-addresses', 'SavedAddressesController');
        Route::resource('edit', 'UserController');
    });
    Route::get('payment-summary/{hash}', 'CheckoutController@summary')->name('payment.summary');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

