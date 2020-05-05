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

Route::get('users', 'PagesController@users');
Route::get('company', 'PagesController@company');

// JSON DATA
Route::post('getusersfilter', 'JSONController@getusersfilter');
Route::post('getcompanyfilter', 'JSONController@getcompanyfilter');
Route::post('getregisteruserdata', 'JSONController@getregisteruserdata');

Route::post('getsubscriptiondata', 'JSONController@getsubscriptiondata');

Route::post('getcompanydata', 'JSONController@getcompanydata');
Route::post('getuserscompany', 'JSONController@getuserscompany');

Route::post('getuserdetail', 'JSONController@getuserdetail');
Route::post('getcompanydetail', 'JSONController@getcompanydetail');