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

Route::group(['middleware' => ['web', 'auth'], 'as' => 'admin.', 'prefix' => 'admin/carousel'], function() {
    Route::get('/', '\Modules\Carousel\Http\Controllers\CarouselAdminController@index')->name('carousel.index');
    Route::post('store', '\Modules\Carousel\Http\Controllers\CarouselAdminController@store')->name('carousel.store');
    Route::post('save', '\Modules\Carousel\Http\Controllers\CarouselAdminController@save')->name('carousel.save');
    Route::post('{id}/update', '\Modules\Carousel\Http\Controllers\CarouselAdminController@update')->name('carousel.update');
    if (Translation::isEnabled()) {
        Route::get('{id}/{language}/edit', '\Modules\Carousel\Http\Controllers\CarouselAdminController@edit')->name('carousel.edit');
        Route::get('{id}/{language}/destroy', '\Modules\Carousel\Http\Controllers\CarouselAdminController@destroy')->name('carousel.destroy');
        Route::get('{id}/{language?}/add', '\Modules\Carousel\Http\Controllers\CarouselAdminController@add')->name('carousel.add');
    } else {
        Route::get('{id}/edit', '\Modules\Carousel\Http\Controllers\CarouselAdminController@edit')->name('carousel.edit');
        Route::get('{id}/destroy', '\Modules\Carousel\Http\Controllers\CarouselAdminController@destroy')->name('carousel.destroy');
        Route::get('{id}/add', '\Modules\Carousel\Http\Controllers\CarouselAdminController@add')->name('carousel.add');
    }
});
