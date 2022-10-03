<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// all type of users have appelety to view all this routes ..

//front page
Route::get('/', 'HomeController@home')->name('main_page');
Route::get('cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'success';
});

Route::post('/login_both', 'Admin\LoginController@login_both')->name('login_both');



