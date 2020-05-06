<?php

use Illuminate\Support\Facades\Route;

// Backend
Route::group(['prefix' => 'admin'], function(){

   Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
   Route::post('login', 'Auth\LoginController@login')->name('admin.login.post');

	Route::get('/', 'DashboardController@index')->name('admin.dashboard');

	Route::get('profile', 'DashboardController@profile')->name('admin.profile');
	Route::post('/profile/save', 'DashboardController@profileSave')->name('admin.profile.save');
	Route::post('/change/password', 'DashboardController@changePassword')->name('admin.change.password');
	Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

   Route::get('config', 'SettingController@index')->name('admin.config');
   Route::post('config', 'SettingController@update')->name('admin.config.save');

	/* Category CRUD	*/
	Route::get('category/list/{parentSlug?}', 'CategoryController@index')->name('admin.category');
	Route::get('category/create', 'CategoryController@create')->name('admin.category.create');
	Route::get('category/create/{categorySlug}', 'CategoryController@createSubCategory')->name('admin.category.createSubCategory');
	Route::get('category/edit/{slug}', 'CategoryController@edit')->name('admin.category.edit');
	Route::get('category/remove/{slug}/{page?}', 'CategoryController@destroy')->name('admin.category.destroy');

	Route::post('category/store', 'CategoryController@store')->name('admin.category.store');
	Route::post('category/update/{slug}/{page?}', 'CategoryController@update')->name('admin.category.update');
	/* */

   /* Post CRUD  */
   Route::get('post/list', 'PostController@index')->name('admin.post');
   Route::get('post/create', 'PostController@create')->name('admin.post.create');
   Route::get('post/edit/{slug}', 'PostController@edit')->name('admin.post.edit');
   Route::get('post/remove/{slug}/{page?}', 'PostController@destroy')->name('admin.post.destroy');

   Route::post('post/store', 'PostController@store')->name('admin.post.store');
   Route::post('post/update/{slug}/{page?}', 'PostController@update')->name('admin.post.update');
   Route::post('post/get-web-content', 'PostController@getWebContent')->name('admin.post.get-web-content');

   /* */

});


