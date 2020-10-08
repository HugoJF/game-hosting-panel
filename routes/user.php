<?php

/*
|--------------------------------------------------------------------------
| Package routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Front-page routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@home')->name('home');
Route::get('landing', 'HomeController@landing')->name('landing');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Registration routes
|--------------------------------------------------------------------------
*/

Route::middleware(['signed'])->group(function () {
    Route::get('user/{user}', 'AccountController@set')->name('panel-accounts.setup');
    Route::patch('user/{user}', 'AccountController@update')->name('panel-accounts.update');
});

/*
|--------------------------------------------------------------------------
| Authed only routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Home routes
    |--------------------------------------------------------------------------
    */

    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('settings', 'HomeController@settings')->name('settings');

    Route::patch('settings', 'HomeController@update')->name('settings.update');
    /*
    |--------------------------------------------------------------------------
    | Notifications routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('notifications')->group(function () {
        Route::get('/', 'NotificationController@index')->name('notifications.index')->middleware('can:list,App\Notification');
    });

    /*
    |--------------------------------------------------------------------------
    | Transactions routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('transactions')->group(function () {
        Route::get('/', 'TransactionController@index')->name('transactions.index')->middleware('can:list,App\Transaction');
    });

    /*
    |--------------------------------------------------------------------------
    | User routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('users')->group(function () {
        Route::get('{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:update,user');

        Route::patch('{user}', 'UserController@update')->name('users.update')->middleware('can:update,user');
    });

    /*
    |--------------------------------------------------------------------------
    | API Keys routes
    |--------------------------------------------------------------------------
    */

    //    Route::prefix('api-keys')->group(function () {
    //        Route::get('/', 'ApiKeyController@index')->name('api-keys.index')->middleware('can:index,App\ApiKey');
    //        Route::get('create', 'ApiKeyController@create')->name('api-keys.create')->middleware('can:create,App\ApiKey');
    //        Route::get('{key}', 'ApiKeyController@edit')->name('api-keys.edit')->middleware('can:update,key');
    //
    //        Route::post('/', 'ApiKeyController@store')->name('api-keys.store')->middleware('can:create,App\ApiKey');
    //
    //        Route::patch('{key}', 'ApiKeyController@update')->name('api-keys.update')->middleware('can:update,key');
    //
    //        Route::delete('{key}', 'ApiKeyController@destroy')->name('api-keys.destroy')->middleware('can:delete,key');
    //    });

    /*
    |--------------------------------------------------------------------------
    | Coupon routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('coupons')->group(function () {
        Route::get('/', 'CouponController@index')->name('coupons.index')->middleware('can:index,App\Coupon');
        Route::get('create', 'CouponController@create')->name('coupons.create')->middleware('can:create,App\Coupon');
        Route::get('{coupon}', 'CouponController@show')->name('coupons.show')->middleware('can:view,coupon');
        Route::get('{coupon}/edit', 'CouponController@edit')->name('coupons.edit')->middleware('can:update,coupon');

        Route::post('{coupon}/use', 'CouponController@use')->name('coupons.use')->middleware('can:use,coupon');
        Route::post('/', 'CouponController@store')->name('coupons.store')->middleware('can:create,App\Coupon');

        Route::patch('{coupon}', 'CouponController@update')->name('coupons.update')->middleware('can:update,coupon');

        Route::delete('{coupon}', 'CouponController@destroy')->name('coupons.destroy')->middleware('can:delete,coupon');
    });

    /*
    |--------------------------------------------------------------------------
    | Order routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders.index')->middleware('can:list,App\Order');
        Route::get('create', 'OrderController@create')->name('orders.create')->middleware('can:create,App\Order');
        Route::get('create/{value}', 'OrderController@store')->name('orders.store')->middleware('can:create,App\Order');
    });

    /*
    |--------------------------------------------------------------------------
    | Server routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('servers')->middleware('panel.id')->group(function () {
        Route::get('/', 'ServerController@index')->name('servers.index');
        Route::get('create', 'ServerController@create')->name('servers.create');

        Route::get('{server}', 'ServerController@show')->name('servers.show');
        Route::get('{server}/deploying', 'ServerController@deploying')->name('servers.deploying');
        Route::get('{server}/configure', 'ServerController@configure')->name('servers.configure');

        Route::post('/', 'ServerController@store')->name('servers.store')->middleware('can:create,App\Server');
        Route::post('{server}/deploy', 'ServerController@deploy')->name('servers.deploy')->middleware('can:deploy,server');

        Route::patch('{server}', 'ServerController@update')->name('servers.update')->middleware('can:update,server');

        // TODO: patch
        Route::get('{server}/terminate', 'ServerController@terminate')->name('servers.terminate')->middleware('can:terminate,server');
        Route::get('{server}/force-terminate', 'ServerController@forceTerminate')->name('servers.force-terminate')->middleware('can:forceTerminate,server');

        Route::delete('{server}', 'ServerController@destroy')->name('servers.destroy')->middleware('can:destroy,server');

        Route::prefix('deploys')->group(function () {
            Route::get('{server}', 'DeployController@server')->name('servers.deploys');
        });

        Route::prefix('transactions')->group(function () {
            Route::get('{server}', 'TransactionController@server')->name('servers.transactions');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Deploy routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('deploys')->group(function () {
        //
    });
});
