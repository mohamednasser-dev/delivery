<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// all type of users have appelety to view all this routes ..

//front page
Route::get('/', 'HomeController@home')->name('main_page');
Route::get('/cache', 'HomeController@cache')->name('cache');

Route::post('/login_both', 'Admin\LoginController@login_both')->name('login_both');



