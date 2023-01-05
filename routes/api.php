<?php

use App\Http\Controllers\Api\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Api\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Api\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Api\Restaurant\CategoriesController;
use App\Http\Controllers\Api\Restaurant\AttributesController;
use App\Http\Controllers\Api\Restaurant\ProfileController;
use App\Http\Controllers\Api\Restaurant\OptionsController;
use App\Http\Controllers\Api\Customer\LocationsController;
use App\Http\Controllers\Api\Restaurant\AddonsController;
use App\Http\Controllers\Api\Restaurant\OrdersController;
use App\Http\Controllers\Api\Customer\FavoriteController;
use App\Http\Controllers\Api\Restaurant\MealsController;
use App\Http\Controllers\Api\Restaurant\AuthController;
use App\Http\Controllers\Api\Customer\HomeController;
use App\Http\Controllers\Api\Customer\RestaurantController;
use App\Http\Controllers\Api\Customer\CopounController;
use App\Http\Controllers\Api\Customer\RestaurantReviewsController;
use App\Http\Controllers\Api\HelpersController;
use Illuminate\Support\Facades\Route;

//restaurant
//Not required restaurant login
Route::prefix('restaurant')->group(function () {
    Route::prefix('auth')->group(function () {
        //register
        Route::prefix('register')->group(function () {
            Route::post('/', [AuthController::class, 'register']);
            Route::post('/send_email_check_code', [AuthController::class, 'send_email_check_code']);
            Route::post('/verify_email', [AuthController::class, 'verify_email']);
            Route::post('/send_phone_check_code', [AuthController::class, 'send_phone_check_code']);
            Route::post('/verify_phone', [AuthController::class, 'verify_phone']);
        });

        //login
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
        //forget_password
        Route::prefix('forget_password')->group(function () {
            Route::post('/', [AuthController::class, 'forget_password']);
            Route::post('/verify_code', [AuthController::class, 'forget_password_verify_code']);
            Route::post('/change_password', [AuthController::class, 'forget_password_change_password']);
        });
    });
});

//required restaurant login
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
        Route::get('/meals-by-category', [MealsController::class, 'mealsByCategory']);
        Route::post('/store', [MealsController::class, 'store']);
        Route::post('/update', [MealsController::class, 'update'])->name('meals.update');
        Route::get('/destroy', [MealsController::class, 'destroy']);
        Route::post('/add-item', [MealsController::class, 'addItem']);
        Route::get('/destroy-item', [MealsController::class, 'deleteItem']);
    });
    Route::get('/meal-search/get', [MealsController::class, 'search']);
    Route::get('/meal-filter/get', [MealsController::class, 'filter']);

    //orders
    Route::prefix('orders')->group(function () {
        Route::get('/{type?}', [OrdersController::class, 'getOrdersByType']);
//        Route::get('/search', [OrdersController::class, 'search']);
        Route::post('/update-status', [OrdersController::class, 'updateStatus']);
//        Route::get('/details', [OrdersController::class, 'orderDetails']);
    });

    Route::get('/order-search/get', [OrdersController::class, 'search']);
    Route::get('/order-filter/get', [OrdersController::class, 'filter']);
    Route::get('/order-details/get', [OrdersController::class, 'orderDetails']);
});

//customer
//not required customer login
Route::prefix('customer')->group(function () {
    //auth
    Route::prefix('auth')->group(function () {
        //register
        Route::prefix('register')->group(function () {
            Route::post('/', [CustomerAuthController::class, 'register']);
            Route::post('/send_email_check_code', [CustomerAuthController::class, 'send_email_check_code']);
            Route::post('/verify_email', [CustomerAuthController::class, 'verify_email']);
            Route::post('/send_phone_check_code', [CustomerAuthController::class, 'send_phone_check_code']);
            Route::post('/verify_phone', [CustomerAuthController::class, 'verify_phone']);
        });
        //login
        Route::post('/login', [CustomerAuthController::class, 'login']);
        Route::post('/social-login', [CustomerAuthController::class, 'socialLogin']);
        Route::post('/refresh-token', [CustomerAuthController::class, 'refreshToken']);
        //forget_password
        Route::prefix('forget_password')->group(function () {
            Route::post('/', [CustomerAuthController::class, 'forget_password']);
            Route::post('/verify_code', [CustomerAuthController::class, 'forget_password_verify_code']);
            Route::post('/change_password', [CustomerAuthController::class, 'forget_password_change_password']);
        });
    });

    //Home
    Route::get('home', [HomeController::class, 'index']);
    Route::get('search-restaurants', [HomeController::class, 'searchRestaurants']);
    Route::get('search-sections', [HomeController::class, 'searchSections']);

    Route::get('restaurant/details-menu-meals', [RestaurantController::class, 'restaurantDetailsMenuMeals']);
    Route::get('restaurant/meal-details', [RestaurantController::class, 'mealDetails']);

    Route::post('check-copoun', [CopounController::class, 'checkCopoun']);

});

//required customer login
Route::middleware(['auth:sanctum'])->prefix('customer')->group(function () {
    //logout
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    //profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [CustomerProfileController::class, 'profile']);
        Route::post('/update', [CustomerProfileController::class, 'update_profile']);
        Route::post('/update_password', [CustomerProfileController::class, 'update_password']);
    });
    //location
    Route::prefix('location')->group(function () {
        Route::get('/', [LocationsController::class, 'index']);
        Route::post('/create', [LocationsController::class, 'create']);
        Route::post('/update', [LocationsController::class, 'update']);
    });
    //favorites
    Route::prefix('favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/store', [FavoriteController::class, 'store']);
    });

    //reviews
    Route::prefix('review')->group(function () {
        Route::post('/store', [RestaurantReviewsController::class, 'store']);
    });

    //order
    Route::prefix('order')->group(function () {
        Route::post('/store', [CustomerOrderController::class, 'store']);
        Route::get('/get-details', [CustomerOrderController::class, 'getOrderDetails']);
    });

});

//helpers
Route::group(['prefix' => 'helpers'], function () {
    Route::get('owner_types', [HelpersController::class, 'owner_types']);
    Route::get('restaurant_types', [HelpersController::class, 'restaurant_types']);
    Route::get('nationalities', [HelpersController::class, 'nationalities']);
    Route::get('settings', [HelpersController::class, 'settings']);
    Route::get('sections', [HelpersController::class, 'sections']);
    Route::get('cancel_reasons', [HelpersController::class, 'cancel_reasons']);
});
