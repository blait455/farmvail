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

Route::view('/home', 'panel.dashboard.index')->name('home');

Route::namespace('Panel')->prefix('panel')->name('panel.')->middleware('can:manage-users')->group(function() {
    Route::resource('/users', 'UsersController', ['except' => ['show', 'create', 'store']]);
});
