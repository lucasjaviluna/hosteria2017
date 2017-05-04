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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
      //return view('admin.home');
      //return Redirect::to('admin/promociones');
      return redirect()->route('admin.promociones');
    })->name('admin.home');

    //Gallery
    Route::get('galeria', 'AdminController@gallery')->name('admin.galeria');
    Route::post('visibleImage/{id?}', 'AdminController@visibleImage')->name('admin.visibleImage');
    Route::post('removeImage/{id?}', 'AdminController@removeImage')->name('admin.removeImage');
    Route::post('sortImages/{ids?}', 'AdminController@sortImages')->name('admin.sortImages');

    //Promotion
    Route::get('promociones/{id?}', 'AdminController@promotion')->name('admin.promociones');
    Route::post('visiblePromotion/{id?}', 'AdminController@visiblePromotion')->name('admin.visiblePromotion');
    Route::post('removePromotion/{id?}', 'AdminController@removePromotion')->name('admin.removePromotion');
    Route::post('sortPromotions/{ids?}', 'AdminController@sortPromotions')->name('admin.sortPromotions');

    //Fish
    Route::get('pesca', function () {
      return view('admin.pesca');
    })->name('admin.pesca');
});

Route::post('image.upload', 'AdminController@uploadImages')->name('image.upload');
Route::post('promotion.create', 'AdminController@createPromotion')->name('promotion.create');

Auth::routes();

Route::get('/home', 'HomeController@index');
