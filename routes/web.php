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

Route::post('users', 'PagesController@users');

Route::post('getusersfilter', 'JSONController@getusersfilter');

Route::post('getregisteruserdata', 'JSONController@getregisteruserdata');