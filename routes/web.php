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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth.basic']], function () {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/search', 'UserController@search')->name('users.search');
    Route::get('/users/{user}','UserController@store')->name('users.store');
    Route::get('show/{user}','UserController@show')->name('users.show');
    Route::get('users/update/{user}','UserController@update')->name('users.update');
    Route::get('users/delete/{user}','UserController@destroy')->name('users.delete');
    Route::post('/autocomplete', 'UserController@autocomplete')->name('users.autocomplete');
});
