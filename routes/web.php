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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bike', 'App\Http\Controllers\BikeController@index')->name('bikeIndex');
Route::get('/bike/create', 'App\Http\Controllers\BikeController@create')->name('bikeCreate');
Route::post('/bike/store', 'App\Http\Controllers\BikeController@store')->name('bikeStore');
Route::get('/bike/edit{$id}', 'App\Http\Controllers\BikeController@edit')->name('bikeEdit')
