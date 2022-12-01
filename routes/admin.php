<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ScreenController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RestaurantDashboardController;
use App\Http\Controllers\Admin\RestaurantsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\AddonsController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\MealsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\OwnerTypesController;
use App\Http\Controllers\Admin\RestaurantTypesController;
use App\Http\Controllers\Admin\NationalitiesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\usersController;
use App\Http\Controllers\Admin\RestaurantSettingsController;
use App\Http\Controllers\Admin\RestaurantBalanceController;
use App\Http\Controllers\Admin\RestaurantTransactionsController;
use App\Http\Controllers\Admin\RestaurantOrdersController;

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
    Route::post('users/update/{id}', [usersController::class, 'update'])->name('users.update_new');

    Route::get('/get_collage_by_role_id/{id}', 'Admin\UsersController@get_collage_by_role_id');
    Route::get('users/{id}/delete', 'Admin\UsersController@destroy');
    Route::post('users/actived', 'Admin\UsersController@update_status')->name('users.actived');

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

        Route::get('/', [RestaurantTypesController::class, 'index'])->name('.index');
        Route::get('create', [RestaurantTypesController::class, 'create'])->name('.create');
        Route::post('store', [RestaurantTypesController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [RestaurantTypesController::class, 'edit'])->name('.edit');
        Route::post('update/{id}', [RestaurantTypesController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [RestaurantTypesController::class, 'destroy'])->name('.destroy');
    });

    //nationalities
    Route::group(['prefix' => 'nationalities', 'as' => 'nationalities'], function () {
        Route::get('/', [NationalitiesController::class, 'index'])->name('.index');
        Route::get('create', [NationalitiesController::class, 'create'])->name('.create');
        Route::post('store', [NationalitiesController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [NationalitiesController::class, 'edit'])->name('.edit');
        Route::post('update/{id}', [NationalitiesController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [NationalitiesController::class, 'destroy'])->name('.destroy');
    });


    //customers
    Route::group(['prefix' => 'customers', 'as' => 'customers'], function () {
        Route::get('/', [CustomersController::class, 'index'])->name('.index');
        Route::get('create', [CustomersController::class, 'create'])->name('.create');
        Route::post('store', [CustomersController::class, 'store'])->name('.store');
        Route::get('edit/{id}', [CustomersController::class, 'edit'])->name('.edit');
        Route::post('update/{id}', [CustomersController::class, 'update'])->name('.update');
        Route::get('delete/{id}', [CustomersController::class, 'destroy'])->name('.destroy');
        Route::get('/change_status/{id}/{status}', [CustomersController::class, 'change_status'])->name('.change_status');

        //dashboard
        Route::get('/dashboard/{id}', [RestaurantDashboardController::class, 'index'])->name('.dashboard.index');
        Route::get('/dashboard/{id}/{type}', [RestaurantDashboardController::class, 'show'])->name('.dashboard.show');

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
        Route::post('/store/{id}', [CategoriesController::class, 'store'])->name('.store');
        Route::get('change_status', [CategoriesController::class, 'change_status'])->name('.change_status');
        Route::post('update_new', [CategoriesController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [CategoriesController::class, 'destroy'])->name('.delete');
    });
    //attributes
    Route::group(['prefix' => 'attributes', 'as' => 'attributes'], function () {
        Route::post('/store/{id}', [AttributesController::class, 'store'])->name('.store');
        Route::get('change_status', [AttributesController::class, 'change_status'])->name('.change_status');
        Route::post('update_new', [AttributesController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [AttributesController::class, 'destroy'])->name('.delete');
        Route::get('get_attribute_options/{id}', [AttributesController::class, 'get_attribute_options'])->name('.get_attribute_options');

    });
    //options
    Route::group(['prefix' => 'options', 'as' => 'options'], function () {
        Route::post('/store', [OptionsController::class, 'store'])->name('.store');
        Route::post('update_new', [OptionsController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [OptionsController::class, 'destroy'])->name('.delete');
    });
    //addons
    Route::group(['prefix' => 'addons', 'as' => 'addons'], function () {
        Route::post('/store/{id}', [AddonsController::class, 'store'])->name('.store');
        Route::get('change_status', [AddonsController::class, 'change_status'])->name('.change_status');
        Route::post('update_new', [AddonsController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [AddonsController::class, 'destroy'])->name('.delete');
    });

    //meals
    Route::group(['prefix' => 'meals', 'as' => 'meals'], function () {
        Route::get('/{id}', [MealsController::class, 'index'])->name('.index');
        Route::post('/store/{id}', [MealsController::class, 'store'])->name('.store');
        Route::get('/edit/{id}', [MealsController::class, 'edit'])->name('.edit');
        Route::get('change_status', [MealsController::class, 'change_status'])->name('.change_status');
        Route::put('update_new', [MealsController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [MealsController::class, 'destroy'])->name('.delete');
        Route::get('attribute/data', [MealsController::class, 'attribute_data'])->name('.attribute.data');
        Route::get('addon/data', [MealsController::class, 'addon_data'])->name('.addon.data');
    });

    //orders
    Route::group(['prefix' => 'orders', 'as' => 'orders'], function () {
        Route::get('/{id}', [OrdersController::class, 'index'])->name('.index');
        Route::post('/store/{id}', [OrdersController::class, 'store'])->name('.store');
        Route::get('change_status', [OrdersController::class, 'change_status'])->name('.change_status');
        Route::post('update_new', [OrdersController::class, 'update'])->name('.update_new');
        Route::get('delete/{id}', [OrdersController::class, 'destroy'])->name('.delete');
        Route::get('attribute_data', [OrdersController::class, 'attribute_data'])->name('.attribute.data');
        Route::get('addon_data', [OrdersController::class, 'addon_data'])->name('.addon.data');
    });
    //balance
    Route::group(['prefix' => 'restaurant_balance', 'as' => 'restaurant_balance'], function () {
        Route::get('/{id}', [RestaurantBalanceController::class, 'index'])->name('.index');
        Route::post('update', [RestaurantBalanceController::class, 'update'])->name('.update');
    });
    //restaurant_transactions
    Route::group(['prefix' => 'restaurant_transactions', 'as' => 'restaurant_transactions'], function () {
        Route::get('/{id}', [RestaurantTransactionsController::class, 'index'])->name('.index');
    });
    //restaurant_transactions
    Route::group(['prefix' => 'restaurant_orders', 'as' => 'restaurant_orders'], function () {
        Route::get('/{id}/{status?}', [RestaurantOrdersController::class, 'index'])->name('.index');
    });
    //restaurant_settings
    Route::group(['prefix' => 'restaurant_settings', 'as' => 'restaurant_settings'], function () {
        Route::get('/{id}', [RestaurantSettingsController::class, 'index'])->name('.index');
        Route::post('update', [RestaurantSettingsController::class, 'update'])->name('.update');
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
