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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin All Route Here
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin'],'as'=>'admin.'],function(){

	Route::get('dashboard','DashboardController@index')->name('dashboard');

});


//Author All Route Here
Route::group(['prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author'],'as'=>'author.'],function(){

	Route::get('dashboard','DashboardController@index')->name('dashboard');

});
