<?php
use Illuminate\Support\Facades\Route;

/* Users  */
Route::post('/login','UserController@login')->name('api-login');
Route::post('/social/login','UserController@socialLogin')->name('api-social-login');
Route::post('/phone/login','UserController@phoneLogin')->name('api-phone-login');
Route::post('/register','UserController@register')->name('api-register');

Route::get('list/horoscope','HoroscopeController@listHoroscopes');

Route::group(['middleware'=>['jwt.verify']],function(){
   Route::get('auth-user','UserController@getUser')->name('auth-user');
   Route::post('user/set-category','UserController@setUserCategories')->name('user.set-category');
   Route::get('/category/user','CategoryController@userCategories')->name('user.category');
   Route::get('/posts/user','PostController@userPosts')->name('api-posts-user');

   Route::post('/polls','PollController@postPoll')->name('api-polls-post');
   Route::post('/quotes','QuoteController@setLike')->name('api-quotes-post');

   Route::get('/memes/like/{meme}', 'LifeHackController@handleMemeLike')->name('memes.handlelike');
   Route::get('/life-hacks/like/{lifehack}', 'LifeHackController@handleLifeHackLike')->name('lifehack.handlelike');

   Route::get('horoscope/{horoscope}/{id?}','HoroscopeController@choose');
   Route::get('predict/horoscope','HoroscopeController@getPredictions');


   /* profile change API */
   Route::post('/user/profile/update','userController@changeProfile')->name('update-profile');
});

Route::get('/quotes','QuoteController@index')->name('api-quotes');

Route::get('/life-hacks', 'LifeHackController@lifeHackListing')->name('life-hacks');
Route::get('/memes', 'LifeHackController@memesListing')->name('memes');

/* Category/Post/Polls API  */
Route::get('/category','CategoryController@index')->name('api-category');
Route::get('/posts/{categoryId?}','PostController@index')->name('api-posts');
Route::get('/polls','PollController@index')->name('api-polls');
/* */

/* RSS Feed API  */
Route::get('/rss-feed','RssController@index')->name('api-rss-feed');
Route::get('/rss-feed/{id}','RssController@getFeedData')->name('api-rss-feed.data');
/* */

