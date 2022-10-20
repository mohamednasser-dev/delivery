<?php

use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Restaurant\ProfileController;
use App\Http\Controllers\Api\Restaurant\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/restaurant/auth/register', 'Api\Restaurant\AuthController@register');

Route::post('/restaurant/auth/register/send_email_check_code', 'Api\Restaurant\AuthController@send_email_check_code');
Route::post('/restaurant/auth/register/verify_email', 'Api\Restaurant\AuthController@verify_email');

Route::post('/restaurant/auth/register/send_phone_check_code', 'Api\Restaurant\AuthController@send_phone_check_code');
Route::post('/restaurant/auth/register/verify_phone', 'Api\Restaurant\AuthController@verify_phone');

Route::post('/restaurant/auth/login', [AuthController::class, 'login']);


Route::middleware(['auth:sanctum'])->prefix('restaurant')->group(function () {

    Route::get('/auth/logout', [AuthController::class, 'logout']);

    //profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile']);
        Route::post('/update', [ProfileController::class, 'update_profile']);
        Route::post('/update_password', [ProfileController::class, 'update_password']);
    });

    //categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index']);
        Route::post('/store', [CategoriesController::class, 'store']);
        Route::post('/update', [CategoriesController::class, 'update'])->name('categories.update');
        Route::get('/destroy', [CategoriesController::class, 'destroy']);
    });

});

//helpers
Route::group(['prefix' => 'helpers'], function () {

    Route::get('/owner_types', 'Api\HelpersController@owner_types');
    Route::get('/restaurant_types', 'Api\HelpersController@restaurant_types');
    Route::get('/nationalities', 'Api\HelpersController@nationalities');
});
