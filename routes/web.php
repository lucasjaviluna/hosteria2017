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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
      return view('admin.home');
    });

    Route::get('galeria', 'AdminController@galeria')->name('admin.galeria');
    Route::post('visibleImage/{id?}', 'AdminController@visibleImage')->name('admin.visibleImage');
    Route::post('removeImage/{id?}', 'AdminController@removeImage')->name('admin.removeImage');
    Route::post('sortImages/{ids?}', 'AdminController@sortImages')->name('admin.sortImages');

    Route::get('promociones', function () {
      return view('admin.promocion');
    })->name('admin.promociones');

    Route::get('pesca', function () {
      return view('admin.pesca');
    })->name('admin.pesca');
});

Route::post('image.upload', 'AdminController@uploadImages')->name('image.upload');

Auth::routes();

Route::get('/home', 'HomeController@index');
