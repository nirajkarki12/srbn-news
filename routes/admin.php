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
	Route::get('category/list', 'CategoryController@index')->name('admin.category');
	Route::get('category/create', 'CategoryController@create')->name('admin.category.create');
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

   /* Poll CRUD  */
   Route::get('poll/list', 'PollController@index')->name('admin.poll');
   Route::get('poll/create', 'PollController@create')->name('admin.poll.create');
   Route::get('poll/edit/{slug}', 'PollController@edit')->name('admin.poll.edit');
   Route::get('poll/remove/{slug}/{page?}', 'PollController@destroy')->name('admin.poll.destroy');

   Route::post('poll/store', 'PollController@store')->name('admin.poll.store');
   Route::post('poll/update/{slug}/{page?}', 'PollController@update')->name('admin.poll.update');
   /* */

   /* RSS CRUD  */
   Route::get('rss', 'RssController@index')->name('admin.rss');
   Route::get('rss/edit/{slug}', 'RssController@edit')->name('admin.rss.edit');
   Route::get('rss/remove/{slug}/{page?}', 'RssController@destroy')->name('admin.rss.destroy');

   Route::post('rss/store', 'RssController@store')->name('admin.rss.store');
   Route::post('rss/update/{slug}/{page?}', 'RssController@update')->name('admin.rss.update');
   /* */

    /* QUOTE CRUD  */
    Route::get('quote', 'QuoteController@index')->name('admin.quote');
    Route::get('quote/edit/{id}', 'QuoteController@edit')->name('admin.quote.edit');
    Route::get('quote/remove/{id}/{page?}', 'QuoteController@destroy')->name('admin.quote.destroy');

    Route::post('quote/store', 'QuoteController@store')->name('admin.quote.store');
    Route::post('quote/update/{id}/{page?}', 'QuoteController@update')->name('admin.quote.update');
    /* */

});


