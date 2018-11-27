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


 Route::get('/', function () {
     return view('welcome');
 });

//Login ke halaman
Route::get('/login', 'LoginController@index');
Route::post('/login/validate', 'LoginController@ceklogin');
Route::post('/logout', 'LoginController@cekLogout');

//Menu backend
Route::get('/home', 'HomeController@index');
Route::post('/backend/upload', 'ZipController@uploadData')->name("upload");
Route::get('/backend/coba', 'ZipController@coba');

Route::group(['middleware' => ['loginverification']], function () {
//    Menu backend
    Route::get('/backend/home', 'LoginController@loginMenu');
    Route::get('/backend/home/sh', 'HomeController@sh');
    Route::get('/backend/uploadData', 'ZipController@index');
    Route::get('/backend/dataSHP', 'ZipController@show');
});