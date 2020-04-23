<?php
use Illuminate\Support\Facades\Route;

/* Users  */
Route::post('/login','UserController@login')->name('api-login');
Route::post('/register','UserController@register')->name('api-register');

Route::group(['middleware'=>['jwt.verify']],function(){
   Route::get('auth-user','UserController@getUser')->name('auth-user');
});

/* Post/Category API  */
Route::get('/posts/{categoryId?}','PostController@index')->name('api-posts');
Route::get('/category','CategoryController@index')->name('api-category');
/* */
