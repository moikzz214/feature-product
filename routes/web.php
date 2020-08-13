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

Route::get('/builder', 'BuilderController@index')->name('builder');
Route::get('/builder/dashboard', 'BuilderController@index')->name('builder.dashboard');
Route::get('/builder/product/new', 'BuilderController@index')->name('builder.new.product');
Route::post('/builder/product/store', 'ProductsController@store')->name('builder.store.product');
Route::get('/builder/product/edit/{slug}', 'BuilderController@index')->name('builder.edit.product');
Route::get('/builder/products', 'BuilderController@index')->name('builder.products');
