<?php

use App\Http\Controllers\Accessory;
use App\Http\Controllers\AccessoryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('/bike', 'App\Http\Controllers\BikeController@index')->name('bikeIndex')->middleware('auth');
Route::get('/bike/create', 'App\Http\Controllers\BikeController@create')->name('bikeCreate')->middleware('auth');
Route::post('/bike/store', 'App\Http\Controllers\BikeController@store')->name('bikeStore')->middleware('auth');
Route::any('/bike/category','App\Http\Controllers\BikeController@category')->name('category')->middleware('auth');
Route::any('/bike/category{id}','App\Http\Controllers\BikeController@editCategory')->name('editCategory')->middleware('auth');
Route::any('/accessory',[AccessoryController::class,'index'])->name('indexAccessory');
Route::any('/accessory/create',[AccessoryController::class,'create'])->name('createAccessory');
Route::any('/accessory/store',[AccessoryController::class,'store'])->name('StoreAccessory');

Route::get('/bike/edit{id}', 'App\Http\Controllers\BikeController@edit')->name('bikeEdit')->middleware('auth');
Route::put('/bike/update{id}','App\Http\Controllers\BikeController@update')->name('bikeUpdate')->middleware('auth');
Route::put('/bike/manutenzione{id}', 'App\Http\Controllers\BikeController@manutenzione')->name('bikeManutenzione')->middleware('auth');
Route::delete('/bike/delete{id}', 'App\Http\Controllers\BikeController@destroy' )->name('bikeDelete')->middleware('auth');

Route::get('/contract', 'App\Http\Controllers\ContractController@index')->name('contractIndex')->middleware('auth');
Route::get('/contract/create', 'App\Http\Controllers\ContractController@create')->name('contractCreate')->middleware('auth');
Route::post('/contract/store', 'App\Http\Controllers\ContractController@store')->name('contractStore')->middleware('auth');
Route::get('/contract/update{id}', 'App\Http\Controllers\ContractController@edit')->name('contractEdit')->middleware('auth');
Route::get('/contract/delete{id}', 'App\Http\Controllers\ContractController@delete')->name('contractDelete')->middleware('auth');
Route::delete('/contract/accessory/delete{id}', 'App\Http\Controllers\ContractController@updateAccessory')->name('contractAccessoryDelete')->middleware('auth');
Route::delete('/contract/bike/delete{id}', 'App\Http\Controllers\ContractController@updateBike')->name('contractBikeDelete')->middleware('auth');
Route::any('/contract/bike{id}', 'App\Http\Controllers\ContractController@bikeChosing' )->name('contractBikeChosing')->middleware('auth');
Route::any('/contract/bike/storing{id}','App\Http\Controllers\ContractController@bikeStoring' )->name('contractBikeStoring')->middleware('auth');
Route::any('/contract/signature{id}', 'App\Http\Controllers\ContractController@signature')->name('contractSignature');
Route::any('/contract/signature/upload{id}', 'App\Http\Controllers\ContractController@signatureUpload')->name('contractSignatureUpload')->middleware('auth');
Route::any('/contract/mail{id}', 'App\Http\Controllers\ContractController@sendMail')->name('contractMail')->middleware('auth');
Route::any('/contract/sms{id}', 'App\Http\Controllers\ContractController@sendSms')->name('contractSms')->middleware('auth');
Route::any('/contract/pdf{id}', 'App\Http\Controllers\ContractController@generaPdf')->name('contractPdf')->middleware('auth');
Route::any('/contract/signature/pdfEmpty', 'App\Http\Controllers\ContractController@generaemptyPdf')->name('emptycontractPdf')->middleware('auth');

Route::get('/contract/show{id}', 'App\Http\Controllers\ContractController@show')->name('contractShow')->middleware('auth');
Route::get('/contract/edit{id}', 'App\Http\Controllers\ContractController@edit')->name('contractEdit')->middleware('auth');
Route::put('/contract/update{id}','App\Http\Controllers\ContractController@update')->name('contractUpdate')->middleware('auth');
// Route::put('/contract/manutenzione{id}', 'App\Http\Controllers\ContractController@manutenzione')->name('contractManutenzione')->middleware('auth');
Route::delete('/contract/delete{id}', 'App\Http\Controllers\ContractController@destroy' )->name('contractDelete')->middleware('auth');
Route::any('/booking/select', 'App\Http\Controllers\UserBooking@select')->name('bookingSelect')->middleware('lang');
Route::get('/booking/bookingCheck', 'App\Http\Controllers\UserBooking@checkBike')->name('bookingCheck')->middleware('lang');
Route::any('/booking/available','App\Http\Controllers\UserBooking@available')->name('bookingAvaliable')->middleware('lang');
Route::any('/booking/delete','App\Http\Controllers\UserBooking@deleteContract')->name('bookingDelete')->middleware('lang');
Route::get('/booking/done','App\Http\Controllers\UserBooking@donePay')->name('booking.done')->middleware('lang');
Route::get('booking/select/{lang}', function ($lang) {
    App::setlocale($lang);
    session()->put('lang', $lang);
    return redirect()->back();
    
})->name('langChange')->middleware('lang');

