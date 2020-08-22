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
Route::get('/builder/product/edit/{id}', 'BuilderController@index')->name('builder.edit.product');
Route::get('/builder/products', 'BuilderController@index')->name('builder.products');

Route::get('/builder/products/all', 'ProductsController@productsAPI')->name('builder.all.products');
Route::post('/builder/product/store', 'ProductsController@store')->name('builder.store.product');
// Route::get('/builder/scenes/scenes', 'ProductsController@scenesByProductId')->name('builder.scenes.by.product.id');
Route::get('/builder/product/upload-video', 'BuilderController@index')->name('builder.upload.video');
Route::post('/video/store', 'VideoController@store')->name('upload.video');

Route::get('/builder/scenes/product/{id}', 'ScenesController@scenesByProductId')->name('builder.scenes.by.product.id');
// Route::get('/builder/scenes/all', 'ScenesController@scenesAll')->name('builder.all.scenes');
Route::post('/builder/scene/store', 'ScenesController@store')->name('builder.store.scene');


Route::get('/product/{slug}', 'ProductsController@show')->name('single.product');