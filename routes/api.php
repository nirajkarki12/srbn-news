<?php
use Illuminate\Support\Facades\Route;

/* Users  */
Route::post('/login','UserController@login')->name('api-login');
Route::post('/social/login','UserController@socialLogin')->name('api-social-login');
Route::post('/register','UserController@register')->name('api-register');

Route::group(['middleware'=>['jwt.verify']],function(){
   Route::get('auth-user','UserController@getUser')->name('auth-user');
   Route::post('user/set-category','UserController@setUserCategories')->name('user.set-category');
   Route::get('/posts/{categoryId?}','PostController@index')->name('api-posts');
   Route::get('/category/user','CategoryController@userCategories')->name('user.category');
});

/* Category API  */
Route::get('/category','CategoryController@index')->name('api-category');
/* */
