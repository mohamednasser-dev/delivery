<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ScreenController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SettingController;

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
    Route::get('/roles/edit/{id}', 'Admin\RoleController@edit')->name('roles.edit');
    Route::post('/roles/update_permission/{id}', 'Admin\RoleController@update')->name('roles.update_permission');
    Route::post('roles/store_permission', 'Admin\RoleController@store_permission')->name('roles.store_permission');
    Route::get('/roles/destroy/{id}', 'Admin\RoleController@destroy')->name('roles.destroy');

    //owner_types  routes
    Route::resource('owner_types', 'Admin\OwnerTypesController');
    Route::get('/owner_types/{id}/delete_ew', 'Admin\OwnerTypesController@destroy')->name('owner_types.destroy');

    //restaurant_types  routes
    Route::resource('restaurant_types', 'Admin\RestaurantTypesController');
    Route::get('/restaurant_types/{id}/delete_ew', 'Admin\RestaurantTypesController@destroy')->name('restaurant_types.destroy');

    //nationalities  routes
    Route::resource('nationalities', 'Admin\NationalitiesController');
    Route::get('/nationalities/{id}/delete_ew', 'Admin\NationalitiesController@destroy')->name('nationalities.destroy');

    //restaurants  routes
    Route::resource('restaurants', 'Admin\RestaurantsController');
    Route::get('/restaurants/{id}/delete_ew', 'Admin\RestaurantsController@destroy')->name('restaurants.destroy');
    Route::get('/restaurants/change_status/{id}/{status}', 'Admin\RestaurantsController@change_status')->name('restaurants.change_status');


    //pages
    Route::group(['prefix' => 'pages'], function () {
        $permission = 'pages';
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
        $permission = 'screens';
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
        $permission = 'links';
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
