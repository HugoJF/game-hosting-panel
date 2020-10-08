<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
|--------------------------------------------------------------------------
| Cost routes
|--------------------------------------------------------------------------
*/

Route::prefix('cost')->group(function () {
    Route::get('creation', 'CostController@creation')->name('cost.creation');
    Route::get('deployment', 'CostController@deployment')->name('cost.deployment');
});

/*
|--------------------------------------------------------------------------
| Configurer routes
|--------------------------------------------------------------------------
*/

Route::prefix('configurer')->group(function () {
    Route::get('games', 'ConfigurerController@games')->name('configurer.games');
    Route::get('locations', 'ConfigurerController@locations')->name('configurer.locations');
    Route::get('billing-periods', 'ConfigurerController@periods')->name('configurer.periods');
    Route::get('{server}/current-form', 'ConfigurerController@currentForm')->name('configurer.current-form');
    Route::get('games/{game}/locations', 'ConfigurerController@gameLocations')->name('configurer.game-locations');
    Route::get('games/{game}/locations/{location}/parameters', 'ConfigurerController@parameters')->name('configurer.parameters');
});

//Route::prefix('servers')->middleware(['auth'])->group(function () {
//    Route::post('/', 'ServerController@store')->name('api.servers.store');
//});
