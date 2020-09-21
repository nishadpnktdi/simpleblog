<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('blogs', 'BlogController');

Route::get('blogs', 'BlogController@index')->name('blogs');

Route::resource('category', 'CategoryController');

Route::resource('tag', 'TagController');

Route::resource('profile', 'ProfileController');

Route::get('profile', 'ProfileController@index')->name('profile');
