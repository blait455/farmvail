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

Route::namespace('Panel')->prefix('home')->group(function() {
    Route::view('/', 'panel.dashboard.index')->name('home');
    Route::name('panel.')->middleware('can:manage-users')->group(function() {
        Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
        Route::resource('/roles', 'RolesController', ['except' => ['show', 'create']]);
    });
    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::post('/settings', 'SettingController@update')->name('settings.update');
});
