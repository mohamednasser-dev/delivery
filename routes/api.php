<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/restaurant/auth/register', 'Api\Restaurant\AuthController@register');
Route::post('/restaurant/auth/register/verify_email', 'Api\Restaurant\AuthController@verify_email');


//profile
Route::group(['prefix' => 'helpers'], function () {

    Route::get('/owner_types','Api\HelpersController@owner_types');
    Route::get('/restaurant_types','Api\HelpersController@restaurant_types');
    Route::get('/nationalities','Api\HelpersController@nationalities');
});
