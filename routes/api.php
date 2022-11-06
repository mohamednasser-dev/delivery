<?php

use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Restaurant\ProfileController;
use App\Http\Controllers\Api\Restaurant\CategoriesController;
use App\Http\Controllers\Api\Restaurant\AttributesController;
use App\Http\Controllers\Api\Restaurant\OptionsController;
use App\Http\Controllers\Api\Restaurant\AddonsController;
use App\Http\Controllers\Api\Restaurant\MealsController;
use App\Http\Controllers\Api\Restaurant\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/restaurant/auth/register', 'Api\Restaurant\AuthController@register');

Route::post('/restaurant/auth/register/send_email_check_code', 'Api\Restaurant\AuthController@send_email_check_code');
Route::post('/restaurant/auth/register/verify_email', 'Api\Restaurant\AuthController@verify_email');

Route::post('/restaurant/auth/register/send_phone_check_code', 'Api\Restaurant\AuthController@send_phone_check_code');
Route::post('/restaurant/auth/register/verify_phone', 'Api\Restaurant\AuthController@verify_phone');

Route::post('/restaurant/auth/login', [AuthController::class, 'login']);
Route::post('/restaurant/auth/forget_password', [AuthController::class, 'forget_password']);
Route::post('/restaurant/auth/forget_password/verify_code', [AuthController::class, 'forget_password_verify_code']);
Route::post('/restaurant/auth/forget_password/change_password', [AuthController::class, 'forget_password_change_password']);


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

    //attributes
    Route::prefix('attributes')->group(function () {
        Route::get('/', [AttributesController::class, 'index']);
        Route::post('/store', [AttributesController::class, 'store']);
        Route::post('/update', [AttributesController::class, 'update'])->name('attributes.update');
        Route::get('/destroy', [AttributesController::class, 'destroy']);
    });

    //options
    Route::prefix('options')->group(function () {
        Route::get('/', [OptionsController::class, 'index']);
        Route::post('/store', [OptionsController::class, 'store']);
        Route::post('/update', [OptionsController::class, 'update'])->name('options.update');
        Route::get('/destroy', [OptionsController::class, 'destroy']);
    });

    //addons
    Route::prefix('addons')->group(function () {
        Route::get('/', [AddonsController::class, 'index']);
        Route::post('/store', [AddonsController::class, 'store']);
        Route::post('/update', [AddonsController::class, 'update'])->name('addons.update');
        Route::get('/destroy', [AddonsController::class, 'destroy']);
    });

    //meals
    Route::prefix('meals')->group(function () {
        Route::get('/', [MealsController::class, 'index']);
        Route::post('/store', [MealsController::class, 'store']);
        Route::post('/update', [MealsController::class, 'update'])->name('meals.update');
        Route::get('/destroy', [MealsController::class, 'destroy']);
        Route::post('/add-item', [MealsController::class, 'addItem']);
        Route::get('/destroy-item', [MealsController::class, 'deleteItem']);
    });

    //orders
    Route::prefix('orders')->group(function () {
        Route::get('/{type}', [OrdersController::class, 'getOrdersByType']);
        Route::post('/update-status', [OrdersController::class, 'updateStatus']);
//        Route::get('/details', [OrdersController::class, 'orderDetails']);
    });

    Route::prefix('order-details')->group(function () {
        Route::get('/get', [OrdersController::class, 'orderDetails']);
    });



});

//helpers
Route::group(['prefix' => 'helpers'], function () {

    Route::get('/owner_types', 'Api\HelpersController@owner_types');
    Route::get('/restaurant_types', 'Api\HelpersController@restaurant_types');
    Route::get('/nationalities', 'Api\HelpersController@nationalities');
});
