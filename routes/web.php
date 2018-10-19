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

use App\cashCollections;
use App\review;
use App\User;
use http\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



Route::get('/', function () {
    return view('index');
})->name('landing');



Route::get('PrivacyPolicy', function () {
    return view('index');
})->name('policy');


Route::resource('profile','Profile');

Route::get('profile{id}','Profile@show');


Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::get('/termsandco', function (){

    return view('termsandco');

})->name('terms');

Route::post('addreviews/{id?}','Reviews@add_reviews');


Route::get('registration', function (){

        return view('Register');
});


Route::get('mynetwork', 'mynetwork@index')->name('mynetwork');
Route::get('mynetwork/find', 'mynetwork@findpeer')->name('findpeer');

Route::resource('loanrequest', 'loanrequest');

Route::get('peersrequest/{sort?}','loanrequest@showpeers')->name('showpeers');



Route::post('peersrequest/notifi','cashcollection@notification')->name('notify');
Route::get('loanrequest/{loanid}/loandetails','cashcollection@loandetails')->name('loandetails');
Route::post('loandetails/confirm/{id}','cashcollection@confirmcash')->name('confirmed');
Route::get('/contract/download', function(){

    return response()->download(public_path().'/Download/contract.docx');

})->name('download');

Route::get('clear/{id?}','HomeController@Clear')->name('notifyClear');

Route::get('Transactions','TransController@index')->name('transactions');

Route::get('Payback_Schedule','PaybackController@mypayback')->name('payback');

Route::get('Payback_Schedule_Update/{loanid}/{userid}','PaybackController@NewDeadline')->name('updateDate');



