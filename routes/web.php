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
Route::get('/builder/product/edit/{id}', 'BuilderController@edit')->name('builder.edit.product');
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

// Media_files
Route::post('/files/upload', 'FilesController@upload')->name('upload');
Route::get('/files/fetch', 'FilesController@getItemImages')->name('fetch.item.files');
// Route::get('/display/file/{msgid}/{extn}/{filename}', 'FileController@show')->name('file.show');
Route::get('/display/file/{path}', 'FilesController@showImage')->name('show.file');
Route::get('/user/files/{id}', 'FilesController@getUserFilesByID')->name('get.user.files');


// Items Controller
Route::get('/items/by-product/{id}', 'ItemsController@getItemsByProduct')->name('items.by.product');
Route::post('/item/delete/{id}', 'ItemsController@destroy')->name('items.delete');
Route::post('/item/replace/{data}', 'ItemsController@replace')->name('items.replace');
