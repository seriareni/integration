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



//Menu backend
Route::get('/home', 'HomeController@index');
Route::post('/backend/upload', 'ZipController@uploadData')->name("upload");
Route::get('/backend/coba', 'ZipController@coba');
Route::get('/backend/test', 'TestController@show')->name("test");
Route::get('/backend/test/getdata', 'TestController@getdata')->name("test.getdata");
Route::post('/register/post', 'RegisterController@post');

Route::group(['middleware' => ['login-verification']], function () {
//    Menu backend
    Route::get('/logout', 'LoginController@cekLogout');
    Route::get('/backend/home', 'LoginController@loginMenu');
    Route::get('/backend/home/sh', 'HomeController@sh');
    Route::get('/backend/uploadData', 'ZipController@index');
    Route::get('/backend/dataSHP', 'ZipController@show');
    Route::get('/backend/user', 'UserController@index');
    Route::get('/backend/user/delete/{id}', 'UserController@destroy');
    Route::resource('/backend/user', 'UserController');

    Route::get('/backend/addUser', 'UserController@index');
});

//Menu frontend
Route::get('/frontend/home', 'FrontendHomeController@index');
Route::get('/frontend/map', 'FrontendHomeController@showingmap');