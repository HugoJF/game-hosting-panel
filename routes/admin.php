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
| Invitation routes
|--------------------------------------------------------------------------
*/
Route::prefix('invite')->group(function () {
    Route::get('create', 'InviteController@create')->name('invites.create');

    Route::post('/', 'InviteController@store')->name('invites.store');
});

/*
|--------------------------------------------------------------------------
| Location routes
|--------------------------------------------------------------------------
*/

Route::prefix('locations')->group(function () {
    Route::get('/', 'LocationController@index')->name('admins.locations.index');
    Route::get('{location}', 'LocationController@show')->name('admins.locations.show');
    Route::get('{location}/edit', 'LocationController@edit')->name('admins.locations.edit');

    Route::patch('{location}', 'LocationController@update')->name('admins.locations.update');
});

/*
|--------------------------------------------------------------------------
| Announcements routes
|--------------------------------------------------------------------------
*/

Route::prefix('announcements')->group(function () {
    Route::get('/', 'AnnouncementController@index')->name('admins.announcements.index');
    Route::get('create', 'AnnouncementController@create')->name('admins.announcements.create');

    Route::get('{announcement}', 'AnnouncementController@show')->name('admins.announcements.show');
    Route::get('{announcement}/edit', 'AnnouncementController@edit')->name('admins.announcements.edit');

    Route::post('/', 'AnnouncementController@store')->name('admins.announcements.store');

    Route::patch('{announcement}', 'AnnouncementController@update')->name('admins.announcements.update');
});

/*
|--------------------------------------------------------------------------
| Node routes
|--------------------------------------------------------------------------
*/

Route::prefix('nodes')->group(function () {
    Route::get('/', 'NodeController@index')->name('admins.nodes.index');
    Route::get('{node}', 'NodeController@show')->name('admins.nodes.show');
    Route::get('{node}/edit', 'NodeController@edit')->name('admins.nodes.edit');

    Route::patch('{node}', 'NodeController@update')->name('admins.nodes.update');
});

/*
|--------------------------------------------------------------------------
| Game routes
|--------------------------------------------------------------------------
*/

Route::prefix('games')->group(function () {
    Route::get('{game}', 'GameController@show')->name('admins.games.show');
    Route::get('{game}/edit', 'GameController@edit')->name('admins.games.edit');

    Route::patch('{game}', 'GameController@update')->name('admins.games.update');
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

//Route::prefix('transactions')->group(function () {
//    Route::get('/', 'TransactionController@index')->name('admins.transactions.index');
//});

/*
|--------------------------------------------------------------------------
| Coupon routes
|--------------------------------------------------------------------------
*/

//Route::prefix('coupons')->group(function () {
//    Route::get('/', 'CouponController@index')->name('admins.coupons.index');
//});

/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
*/

//Route::prefix('users')->group(function () {
//    Route::get('/', 'UserController@index')->name('admins.users.index');
//});
