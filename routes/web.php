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

Route::get('/dashboard', 'BuilderController@index')->name('builder.dashboard');
Route::get('/builder', 'BuilderController@index')->name('builder');
Route::get('/builder/product/new', 'BuilderController@index')->name('builder.new.product');
Route::get('/builder/product/edit/{id}', 'BuilderController@edit')->name('builder.edit.product');
Route::get('/builder/products', 'BuilderController@index')->name('builder.products');

Route::get('/builder/products/all', 'ProductsController@productsAPI')->name('builder.all.products');
Route::post('/builder/product/store', 'ProductsController@store')->name('builder.store.product');
// Route::get('/builder/scenes/scenes', 'ProductsController@scenesByProductId')->name('builder.scenes.by.product.id');
Route::get('/builder/product/upload-video', 'BuilderController@index')->name('builder.upload.video');
Route::post('/video/store', 'VideoController@store')->name('upload.video');

Route::get('/builder/scenes/product/{id}', 'ScenesController@scenesByProductId')->name('builder.scenes.by.product.id');
Route::post('/builder/scene/store', 'ScenesController@store')->name('builder.store.scene');

// Settings
Route::get('/settings/organization', 'BuilderController@index')->name('settings.organization');
Route::get('/settings/get-org-users/{id}', 'SettingsController@getOrgUsers')->name('settings.org.users');
Route::get('/settings/account', 'BuilderController@index')->name('settings.account');
Route::get('/settings/companies', 'BuilderController@index')->name('settings.companies');

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
// Save or replace depending on the request data
Route::post('/item/save', 'ItemsController@saveItem')->name('items.save');

// Panorama
Route::get('/item/scenes/by-product/{id}', 'ItemsController@getScenesByProductId')->name('item.scenes');

// Hotspots
Route::post('/hotspot/new', 'HotspotsController@store')->name('hotspot.save');
Route::post('/hotspot/update/{id}', 'HotspotsController@update')->name('hotspot.update');
Route::post('/hotspot/set', 'HotspotsController@setHotspot')->name('hotspot.set');
Route::post('/hotspot/delete/{id}', 'HotspotsController@destroy')->name('hotspot.destroy');
Route::get('/hotspot/by-product/{id}/{panel}', 'HotspotsController@allHostspotsByProductId')->name('hotspot.by.product.id');
Route::post('/hotspot/apply', 'HotspotsController@applyHotspot')->name('hotspot.apply');
Route::get('/hotspot/settings/{id}', 'HotspotsController@fetchSettings')->name('hotspot.settings');
Route::post('/hotspot/setting/delete', 'HotspotsController@deleteSetting')->name('hotspot.setting.delete');
Route::get('/hotspot/product/{id}', 'HotspotsController@getProductHotspots')->name('hotspot.product');

Route::get('/hotspot/all/interior/{id}', 'HotspotsController@getAllInteriorHotspotsByProductId')->name('hotspot.all.interior');

// Videos
Route::post('/video/save', 'VideosController@store')->name('video.save');
Route::post('/video/update/{id}', 'VideosController@update')->name('video.update');
Route::post('/video/delete/{id}', 'VideosController@destroy')->name('video.delete');
Route::get('/video/all/{id}', 'VideosController@fetchAllVideos')->name('video.all');