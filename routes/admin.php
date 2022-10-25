<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ScreenController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RestaurantDashboardController;
use App\Http\Controllers\Admin\RestaurantsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OwnerTypesController;
use App\Http\Controllers\Admin\RestaurantTypesController;
use App\Http\Controllers\Admin\NationalitiesController;

Auth::routes();
//Route::get('/', 'HomeController@main_pge')->name('main_page');

//    inboxes


Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('logout/manual', 'Admin\LoginController@logout')->name('admin.logout');

    Route::get('/home', 'Admin\HomeController@index')->name('home');
    //profile
    Route::get('profile', 'Admin\HomeController@profile')->name('profile');
    Route::get('change_pass', 'Admin\HomeController@profile')->name('change_pass');
    Route::post('/change_pass/update/password', 'Admin\HomeController@update_pass')->name('change_pass.update.pass');
    Route::post('/profile/update', 'Admin\HomeController@store_profile')->name('admin.store.profile');

    //users  routes
    Route::resource('users', 'Admin\UsersController');
    //for new join
    Route::get('user/accept/{id}', 'Admin\UsersController@accept')->name('user.accept');
    Route::get('user/reject/{id}', 'Admin\UsersController@reject')->name('user.reject');

    Route::get('/get_collage_by_role_id/{id}', 'Admin\UsersController@get_collage_by_role_id');
    Route::get('users/{id}/delete', 'Admin\UsersController@destroy');
    Route::post('users/actived', 'Admin\UsersController@update_Actived')->name('users.actived');

    //user permissions and roles
    Route::resource('roles', 'Admin\RoleController');
    // Route::post('/store_permission', 'Admin\RoleController@store_permission')->name('store_permission');
    Route::get('/roles/edit/{id}', 'Admin\RoleController@edit')->name('roles.edit_new');
    Route::post('/roles/update_permission/{id}', 'Admin\RoleController@update')->name('roles.update_permission');
    Route::post('roles/store_permission', 'Admin\RoleController@store_permission')->name('roles.store_permission');
    Route::get('/roles/destroy/{id}', 'Admin\RoleController@destroy')->name('roles.destroy_new');

//    //owner_types  routes
//    Route::resource('owner_types', 'Admin\OwnerTypesController');
//    Route::get('/owner_types/{id}/delete_ew', 'Admin\OwnerTypesController@destroy')->name('owner_types.destroy');

    //owner_types
    Route::group(['prefix' => 'owner_types', 'as' => 'owner_types'], function () {
        Route::get('/', [OwnerTypesController::class, 'index'])->name('.index');
        Route::get('create', [OwnerTypesController::class, 'create'])->name('.create');
        Route::post('store', [OwnerTypesController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [OwnerTypesController::class, 'edit'])->name('.edit');
        Route::post('update/{id}', [OwnerTypesController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [OwnerTypesController::class, 'destroy'])->name('.destroy');
    });

    //restaurant_types
    Route::group(['prefix' => 'restaurant_types', 'as' => 'restaurant_types'], function () {

        Route::get('/', [RestaurantTypesController::class, 'index'])->name( '.index');
        Route::get('create', [RestaurantTypesController::class, 'create'])->name( '.create');
        Route::post('store', [RestaurantTypesController::class, 'store'])->name( '.store');
        Route::get('edit/{id}', [RestaurantTypesController::class, 'edit'])->name( '.edit');
        Route::post('update/{id}', [RestaurantTypesController::class, 'update'])->name( '.update');
        Route::get('delete/{id}', [RestaurantTypesController::class, 'destroy'])->name( '.destroy');
    });

    //nationalities
    Route::group(['prefix' => 'nationalities', 'as' => 'nationalities'], function () {
        Route::get('/', [NationalitiesController::class, 'index'])->name( '.index');
        Route::get('create', [NationalitiesController::class, 'create'])->name('.create');
        Route::post('store', [NationalitiesController::class, 'store'])->name( '.store');
        Route::get('edit/{id}', [NationalitiesController::class, 'edit'])->name( '.edit');
        Route::post('update/{id}', [NationalitiesController::class, 'update'])->name( '.update');
        Route::get('delete/{id}', [NationalitiesController::class, 'destroy'])->name( '.destroy');
    });

    //nationalities
    Route::group(['prefix' => 'nationalities', 'as' => 'nationalities'], function () {
        Route::get('/', [NationalitiesController::class, 'index'])->name( '.index');
        Route::get('create', [NationalitiesController::class, 'create'])->name( '.create');
        Route::post('store', [NationalitiesController::class, 'store'])->name( '.store');
        Route::get('edit/{id}', [NationalitiesController::class, 'edit'])->name( '.edit');
        Route::post('update/{id}', [NationalitiesController::class, 'update'])->name( '.update');
        Route::get('delete/{id}', [NationalitiesController::class, 'destroy'])->name('.destroy');
    });

    //restaurants
    Route::group(['prefix' => 'restaurants', 'as' => 'restaurants'], function () {
        Route::get('/', [RestaurantsController::class, 'index'])->name('.index');
        Route::get('create', [RestaurantsController::class, 'create'])->name('.create');
        Route::post('store', [RestaurantsController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [RestaurantsController::class, 'edit'])->name('.edit');
        Route::post('update/{id}', [RestaurantsController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [RestaurantsController::class, 'destroy'])->name('.destroy');
        Route::get('/change_status/{id}/{status}', [RestaurantsController::class, 'change_status'])->name('.change_status');

        //dashboard
        Route::get('/dashboard/{id}', [RestaurantDashboardController::class, 'index'])->name('.dashboard.index');
        Route::get('/dashboard/{id}/{type}', [RestaurantDashboardController::class, 'show'])->name('.dashboard.show');

    });

    //categories
    Route::group(['prefix' => 'categories', 'as' => 'categories'], function () {
        Route::get('/', [CategoriesController::class, 'index']);
        Route::get('create', [CategoriesController::class, 'create'])->name('.create');
        Route::post('/store/{id}', [CategoriesController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('.edit');
        Route::get('change_status', [CategoriesController::class, 'change_status'])->name('.change_status');
//        Route::post('/{id}/update', [CategoriesController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [CategoriesController::class, 'delete'])->name('.delete');
    });
    //pages
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PageController::class, 'index'])->name('pages');
        Route::get('create', [PageController::class, 'create'])->name('pages.create');
        Route::post('store', [PageController::class, 'store'])->name('pages.store');
        Route::get('edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
        Route::post('update/{id}', [PageController::class, 'update'])->name('pages.update');
        Route::post('deletes', [PageController::class, 'deletes'])->name('pages.deletes');
        Route::get('delete/{id}', [PageController::class, 'delete'])->name('pages.delete');
    });

    //screens
    Route::group(['prefix' => 'screens'], function () {
        Route::get('/', [ScreenController::class, 'index'])->name('screens');
        Route::get('create', [ScreenController::class, 'create'])->name('screens.create');
        Route::post('store', [ScreenController::class, 'store'])->name('screens.store');
        Route::get('edit/{id}', [ScreenController::class, 'edit'])->name('screens.edit');
        Route::post('update/{id}', [ScreenController::class, 'update'])->name('screens.update');
        Route::post('deletes', [ScreenController::class, 'deletes'])->name('screens.deletes');
        Route::get('delete/{id}', [ScreenController::class, 'delete'])->name('screens.delete');
    });

    //links
    Route::group(['prefix' => 'links'], function () {
        Route::get('/', [SocialLinkController::class, 'index'])->name('links');
        Route::get('create', [SocialLinkController::class, 'create'])->name('links.create');
        Route::post('store', [SocialLinkController::class, 'store'])->name('links.store');
        Route::get('edit/{id}', [SocialLinkController::class, 'edit'])->name('links.edit');
        Route::post('update/{id}', [SocialLinkController::class, 'update'])->name('links.update');
        Route::post('deletes', [SocialLinkController::class, 'deletes'])->name('links.deletes');
        Route::get('delete/{id}', [SocialLinkController::class, 'delete'])->name('links.delete');
    });

    //settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
    });
});
Route::get('lang/{lang}', 'HomeController@lang')->name('home.lang');
