<?php
use Illuminate\Support\Facades\Route;

/* Users  */
Route::post('/login','UserController@login')->name('api-login');
Route::post('/social/login','UserController@socialLogin')->name('api-social-login');
Route::post('/phone/login','UserController@phoneLogin')->name('api-phone-login');
Route::post('/register','UserController@register')->name('api-register');

Route::group(['middleware'=>['jwt.verify']],function(){
   Route::get('auth-user','UserController@getUser')->name('auth-user');
   Route::post('user/set-category','UserController@setUserCategories')->name('user.set-category');
   Route::get('/category/user','CategoryController@userCategories')->name('user.category');
   Route::get('/posts/user','PostController@userPosts')->name('api-posts-user');

   Route::post('/polls','PollController@postPoll')->name('api-polls-post');

   /* profile change API */
   Route::post('/user/profile/update','userController@changeProfile')->name('update-profile');
});

/* Category/Post/Polls API  */
Route::get('/category','CategoryController@index')->name('api-category');
Route::get('/posts/{categoryId?}','PostController@index')->name('api-posts');
Route::get('/polls','PollController@index')->name('api-polls');
/* */

/* RSS Feed API  */
Route::get('/rss-feed','RssController@index')->name('api-rss-feed');
Route::get('/rss-feed/{id}','RssController@getFeedData')->name('api-rss-feed.data');
/* */

