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

// Route::get('/', function () {
//     return view('site.index');
// });

Route::get('/', 'Site\SiteController@index')->name('index');

Auth::routes();

Route::namespace('Panel')->prefix('home')->group(function() {
    Route::view('/', 'panel.dashboard.index')->name('home')->middleware('auth');
    Route::name('panel.')->group(function() {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']])->middleware('can:manage-users');
        Route::resource('/roles', 'RolesController', ['except' => ['show', 'create']])->middleware('can:manage-users');
        // Route::resource('/categories', 'CategoryController');
        Route::group(['prefix'  =>   'categories'], function() {
            Route::get('/', 'CategoryController@index')->name('categories.index');
            Route::get('/create', 'CategoryController@create')->name('categories.create');
            Route::post('/store', 'CategoryController@store')->name('categories.store');
            Route::get('/{id}/edit', 'CategoryController@edit')->name('categories.edit');
            Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
            Route::get('/{id}/delete', 'CategoryController@delete')->name('categories.delete');
        });
        Route::group(['prefix'  =>   'partners'], function() {
            Route::get('/', 'PartnerController@index')->name('partners.index');
            Route::get('/create', 'PartnerController@create')->name('partners.create');
            Route::post('/store', 'PartnerController@store')->name('partners.store');
            Route::get('/{id}/edit', 'PartnerController@edit')->name('partners.edit');
            Route::post('/update/{id}', 'PartnerController@update')->name('partners.update');
            Route::get('/{id}/delete', 'PartnerController@delete')->name('partners.delete');
        });
        Route::group(['prefix'  =>   'banners'], function() {
            Route::get('/', 'BannerController@index')->name('banners.index');
            Route::get('/create', 'BannerController@create')->name('banners.create');
            Route::post('/store', 'BannerController@store')->name('banners.store');
            Route::get('/{id}/edit', 'BannerController@edit')->name('banners.edit');
            Route::post('/update/{id}', 'BannerController@update')->name('banners.update');
            Route::get('/{id}/delete', 'BannerController@delete')->name('banners.delete');
        });
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductController@index')->name('products.index');
            Route::get('/create', 'ProductController@create')->name('products.create');
            Route::post('/store', 'ProductController@store')->name('products.store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('products.edit');
            Route::post('/update/{id}', 'ProductController@update')->name('products.update');
            Route::get('/{id}/delete', 'ProductController@delete')->name('products.delete');

            Route::post('images/upload', 'ProductImageController@upload')->name('products.images.upload');
            Route::get('images/{id}/delete', 'ProductImageController@delete')->name('products.images.delete');
        });
        Route::group(['prefix' =>   'testimonies'], function() {
            Route::get('/', 'TestimonyController@index')->name('testimonies.index');
            Route::get('/edit/{id}', 'TestimonyController@edit')->name('testimonies.edit');
            Route::post('/update/{id}', 'TestimonyController@update')->name('testimonies.update');
            Route::get('/delete/{id}', 'TestimonyController@delete')->name('testimonies.delete');
        });
    });
    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::post('/settings', 'SettingController@update')->name('settings.update');
});

Route::get('/product/{slug}', 'Site\ProductController@show')->name('product.show');
