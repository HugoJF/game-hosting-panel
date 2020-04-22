<?php

/*
|--------------------------------------------------------------------------
| Package routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Testing routes
|--------------------------------------------------------------------------
|
*/

Route::get('template', function () {
    return view('template.vip');
});

/*
|--------------------------------------------------------------------------
| Front-page routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::get('faq', 'HomeController@faq')->name('faq');

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

    // TODO: Policies
    Route::prefix('users')->group(function () {
        Route::get('{user}/edit', 'UserController@edit')->name('users.edit');

        Route::patch('{user}', 'UserController@update')->name('users.update');
    });

    /*
    |--------------------------------------------------------------------------
    | API Keys routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('api-keys')->group(function () {
        Route::get('/', 'ApiKeyController@index')->name('api-keys.index')->middleware('can:index,App\ApiKey');
        Route::get('create', 'ApiKeyController@create')->name('api-keys.create')->middleware('can:create,App\ApiKey');
        Route::get('{key}', 'ApiKeyController@edit')->name('api-keys.edit')->middleware('can:update,key');

        Route::post('/', 'ApiKeyController@store')->name('api-keys.store')->middleware('can:create,App\ApiKey');

        Route::patch('{key}', 'ApiKeyController@update')->name('api-keys.update')->middleware('can:update,key');

        Route::delete('{key}', 'ApiKeyController@destroy')->name('api-keys.destroy')->middleware('can:delete,key');
    });

    /*
    |--------------------------------------------------------------------------
    | Location routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('locations')->group(function () {
        Route::get('/', 'LocationController@index')->name('locations.index');
        Route::get('{location}', 'LocationController@show')->name('locations.show');
    });

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
        Route::get('/', 'OrderController@index')->name('orders.index');
        Route::get('create', 'OrderController@create')->name('orders.create');
        Route::get('create/{value}', 'OrderController@store')->name('orders.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Node routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('nodes')->group(function () {
        //
    });

    /*
    |--------------------------------------------------------------------------
    | Server routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('servers')->group(function () {
        Route::get('/', 'ServerController@index')->name('servers.index');
        Route::get('{server}', 'ServerController@show')->name('servers.show');
        Route::get('{server}/deploy', 'ServerController@deploy')->name('servers.deploy');
        Route::get('{server}/custom-deploy', 'ServerController@customDeploy')->name('servers.custom-deploy');


        Route::get('create/game', 'ServerController@selectGame')->name('servers.select-game');
        Route::get('create/game/{game}/location', 'ServerController@selectLocation')->name('servers.select-location');
        Route::get('create/game/{game}/location/{location}/configure', 'ServerController@configure')->name('servers.configure');

        Route::post('game/{game}/location/{location}', 'ServerController@store')->name('servers.store');

        // TODO: patch
        Route::get('{server}/terminate', 'ServerController@terminate')->name('servers.terminate');

        Route::delete('{server}', 'ServerController@destroy')->name('servers.destroy');
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
