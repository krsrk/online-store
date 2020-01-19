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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('/dashboard/catalog', 'dashboard\CatalogController');
//Route::resource('/dashboard/product', 'dashboard\productController');
//Route::resource('/dashboard/users', 'dashboard\UserController');
//Route::resource('/dashboard/orders', 'dashboard\OrderController');

Route::group(['prefix' => 'dashboard/products'], function(){
    Route::get('/', 'DashBoard\ProductController@index')->name('dashboard.products');
    Route::get('/show', 'DashBoard\ProductController@show');
    Route::get('/showAll', 'DashBoard\ProductController@showAll');
    Route::post('/create','DashBoard\ProductController@create');
    Route::post('/update','DashBoard\ProductController@update');
    Route::post('/delete','DashBoard\ProductController@destroy');
    Route::post('/publish','DashBoard\ProductController@publishProduct');
    Route::post('/image','Dashboard\ProductController@uploadImage');
});

Route::group(['prefix' => 'dashboard/orders'], function(){
    Route::get('/', 'DashBoard\OrderController@index')->name('dashboard.orders');
    Route::get('/show', 'DashBoard\OrderController@show');
    Route::post('/update','DashBoard\OrderController@update');
    Route::post('/delete','DashBoard\OrderController@destroy');
});
Route::group(['prefix' => 'dashboard/users'], function(){
    Route::get('/', 'DashBoard\UserController@index')->name('dashboard.users');
    Route::get('/show', 'DashBoard\UserController@show');
    Route::post('/update','DashBoard\UserController@update');
    Route::post('/delete','DashBoard\UserController@destroy');
    Route::post('/suspend','DashBoard\UserController@suspend');
    Route::post('/store','DashBoard\UserController@store');
});
