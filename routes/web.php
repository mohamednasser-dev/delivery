<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


//front page
Route::get('/', function (){ if(auth()->user()) return redirect()->route('home'); else return  redirect() ->route('login') ;  })->name('main_page');
Route::get('/cache', 'HomeController@cache')->name('cache');
Route::post('/login_both', 'Admin\LoginController@login_both')->name('login_both');



