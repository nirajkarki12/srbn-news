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


   Route::group(['prefix' => 'lifehack'], function(){
      Route::get('', 'LifeHackController@index')->name('admin.lifehack');
      Route::get('create/{lifehack?}', 'LifeHackController@create')->name('admin.lifehack.create');
      Route::post('store/{lifehack?}', 'LifeHackController@store')->name('admin.lifehack.store');
      Route::get('delete/{lifehack}', 'LifeHackController@destroy')->name('admin.lifehack.delete');
   });

   Route::group(['prefix' => 'meme'], function(){
      Route::get('', 'MemeController@index')->name('admin.meme');
      Route::get('create/{meme?}', 'MemeController@create')->name('admin.meme.create');
      Route::post('store/{meme?}', 'MemeController@store')->name('admin.meme.store');
      Route::get('delete/{meme}', 'MemeController@destroy')->name('admin.meme.delete');
   });

   Route::group(['prefix' => 'horoscope'], function(){
      Route::get('/', 'HoroscopeController@index')->name('admin.horoscope');
      Route::get('create/{horoscope?}', 'HoroscopeController@create')->name('admin.horoscope.create');
      Route::get('delete/{horoscope}', 'HoroscopeController@destroy')->name('admin.horoscope.delete');
      Route::post('store/{horoscope?}', 'HoroscopeController@store')->name('admin.horoscope.store');
   });

   Route::group(['prefix' => 'prediction'], function(){
      Route::get('/', 'PredictionController@index')->name('admin.prediction');
      Route::get('create/{prediction?}', 'PredictionController@create')->name('admin.prediction.create');
      Route::get('delete/{prediction}', 'PredictionController@destroy')->name('admin.prediction.delete');
      Route::post('store/{prediction?}', 'PredictionController@store')->name('admin.prediction.store');
   });

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


