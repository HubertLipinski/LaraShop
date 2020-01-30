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
Route::get('/items/image/{id}/{index}', 'ProductList@getImages')->name('getImages');
Route::get('/items/{id}', 'ProductController@show')->name('showProduct');
Route::post('/items/add', 'ProductController@store')->name('addItem');

Route::get('/sell', 'UserPanelController@sellView')->name('sellItem');
