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

Route::get('posts','PostController@index')->name('post.index');
Route::get('post/{slug}','PostController@details')->name('post.details');

Route::get('category/{slug}','PostController@postByCategory')->name('category.posts');
Route::get('tag/{slug}','PostController@postByTag')->name('tag.posts');

Route::get('profile/{username}','AuthorController@profile')->name('author.profile');

Route::get('search','SearchController@search')->name('search');

Route::group(['middleware'=>['auth']],function(){
	Route::post('favourite/{post}/add','FavouriteController@add')->name('post.favourite');
	Route::post('comment/{post_id}','CommentController@store')->name('comment.store');
});

View::composer('layouts.frontend.partial.footer',function($view){
	$categories = App\Category::all();
	$view->with('categories',$categories);
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

	Route::get('authors','AuthorController@index')->name('author.index');
	Route::delete('author/{id}','AuthorController@destroy')->name('author.destroy');

	Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

});


//Author All Route Here
Route::group(['prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author'],'as'=>'author.'],function(){

	Route::get('settings','SettingController@index')->name('settings');
	Route::put('profile-update','SettingController@updateProfile')->name('profile.update');
	Route::put('password-update','SettingController@updatePassword')->name('password.update');

	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::resource('post','PostController');

	Route::get('favourite','FavouriteController@index')->name('favourite.index');

	Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

});
