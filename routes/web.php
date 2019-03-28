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


Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::post('scubscribe','SubscriberController@store')->name('subscribe.store');

Route::get('post/{slug}','PostController@details')->name('post.details');

Route::group(['middleware'=>['auth']],function(){
	Route::post('favourite/{post}/add','FavouriteController@add')->name('post.favourite');
});



// Admin All Route Here
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin'],'as'=>'admin.'],function(){

	Route::get('settings','SettingController@index')->name('settings');
	Route::put('profile-update','SettingController@updateProfile')->name('profile.update');
	Route::put('password-update','SettingController@updatePassword')->name('password.update');

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('tag','TagController');
	Route::resource('category','CategoryController');
	Route::resource('post','PostController');

	Route::get('favourite','FavouriteController@index')->name('favourite.index');

	Route::get('pending/post','PostController@pending')->name('post.pending');
	Route::put('/post/{id}/approve','PostController@approval')->name('post.approve');

	Route::get('subscriber','SubscriberController@index')->name('subscriber.index');
	Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

});


//Author All Route Here
Route::group(['prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author'],'as'=>'author.'],function(){

	Route::get('settings','SettingController@index')->name('settings');
	Route::put('profile-update','SettingController@updateProfile')->name('profile.update');
	Route::put('password-update','SettingController@updatePassword')->name('password.update');

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('post','PostController');

	Route::get('favourite','FavouriteController@index')->name('favourite.index');

});
