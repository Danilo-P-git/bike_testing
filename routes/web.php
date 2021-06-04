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
Route::get('/bike/edit{id}', 'App\Http\Controllers\BikeController@edit')->name('bikeEdit');
Route::put('/bike/update{id}','App\Http\Controllers\BikeController@update')->name('bikeUpdate');
Route::put('/bike/manutenzione{id}', 'App\Http\Controllers\BikeController@manutenzione')->name('bikeManutenzione');
Route::delete('/bike/delete{id}', 'App\Http\Controllers\BikeController@destroy' )->name('bikeDelete');

Route::get('/contract', 'App\Http\Controllers\ContractController@index')->name('contractIndex');
Route::get('/contract/create', 'App\Http\Controllers\ContractController@create')->name('contractCreate');
Route::post('/contract/store', 'App\Http\Controllers\ContractController@store')->name('contractStore');
Route::get('/contract/edit{id}', 'App\Http\Controllers\ContractController@edit')->name('contractEdit');
Route::put('/contract/update{id}','App\Http\Controllers\ContractController@update')->name('contractUpdate');
// Route::put('/contract/manutenzione{id}', 'App\Http\Controllers\ContractController@manutenzione')->name('contractManutenzione');
Route::delete('/contract/delete{id}', 'App\Http\Controllers\ContractController@destroy' )->name('contractDelete');