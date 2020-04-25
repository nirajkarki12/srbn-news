<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.welcome');
});

/* API Doc  */
 Route::get('/api/docs', function () {
    return view('apidoc.index');
})->middleware('auth')->name('apidoc');
/* */