<?php

/*
|--------------------------------------------------------------------------
| Package routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Admin-only routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'AdminController@dashboard')->name('admins.dashboard');

/*
|--------------------------------------------------------------------------
| Location routes
|--------------------------------------------------------------------------
*/

Route::prefix('locations')->group(function () {
    Route::get('/', 'LocationController@index')->name('admins.locations.index');
    Route::get('{location}', 'LocationController@show')->name('admins.locations.show');
});

/*
|--------------------------------------------------------------------------
| Node routes
|--------------------------------------------------------------------------
*/

Route::prefix('nodes')->group(function () {
    Route::get('/', 'NodeController@index')->name('admins.nodes.index');
    Route::get('{node}', 'NodeController@show')->name('admins.nodes.show');
});

/*
|--------------------------------------------------------------------------
| Server routes
|--------------------------------------------------------------------------
*/

Route::prefix('servers')->group(function () {
    Route::get('/', 'ServerController@index')->name('admins.servers.index');
});

/*
|--------------------------------------------------------------------------
| Transaction routes
|--------------------------------------------------------------------------
*/

Route::prefix('transactions')->group(function () {
    Route::get('/', 'TransactionController@index')->name('admins.transactions.index');
});

/*
|--------------------------------------------------------------------------
| Coupon routes
|--------------------------------------------------------------------------
*/

Route::prefix('coupons')->group(function () {
    Route::get('/', 'CouponController@index')->name('admins.coupons.index');
});

/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
*/

Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('admins.users.index');
});
