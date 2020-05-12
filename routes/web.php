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

Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');

Route::get('users', 'PagesController@users');
Route::get('paymentrequest', 'PagesController@paymentrequest');
Route::get('paymentstatus', 'PagesController@paymentstatus');
Route::get('company', 'PagesController@company');
Route::get('pricing', 'PagesController@pricing');
Route::get('pulldata', 'PagesController@pulldata');

// PULL DATA
Route::post('getData', 'PullDataController@getData');
Route::post('recalculateData', 'PullDataController@recalculateData');

// JSON DATA
Route::post('getusersfilter', 'JSONController@getusersfilter');
Route::post('getpaymentfilter', 'JSONController@getpaymentfilter');
Route::post('getcompanyfilter', 'JSONController@getcompanyfilter');
Route::post('getprice_historyfilter', 'JSONController@getprice_historyfilter');
Route::post('updatePrice', 'PagesController@updatePrice');
Route::post('getregisteruserdata', 'JSONController@getregisteruserdata');
Route::post('getsubscriptiondata', 'JSONController@getsubscriptiondata');
Route::post('getcompanydata', 'JSONController@getcompanydata');
Route::post('getuserscompany', 'JSONController@getuserscompany');
Route::post('getuserdetail', 'JSONController@getuserdetail');
Route::post('getcompanydetail', 'JSONController@getcompanydetail');
Route::post('getpayment_request', 'JSONController@getpayment_request');
Route::post('getpayment', 'JSONController@getpayment');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
