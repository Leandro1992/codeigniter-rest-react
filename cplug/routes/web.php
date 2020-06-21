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

Route::redirect('/', App::getLocale());

Route::group(['prefix' => '{lang}'], function() {

    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/store', 'ProductController@indexStore')->name('store');
    Route::get('/stock', 'StockController@index')->name('stock');
    Route::post('/stock', 'StockController@create')->name('stock.create');
    Route::get('/stock/{product}', 'StockController@check')->name('stock.check');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


    Route::resource('/product', 'ProductController', ['except' => ['show', 'store']]);

    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
        Route::resource('/users', 'UserController', ['except' => ['show', 'create', 'store']]);
    });
});
    
