<?php

use Illuminate\Http\Request;

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
    Route::get('games/{game}/locations', 'ConfigurerController@gameLocations')->name('configurer.gameLocations');
    Route::get('games/{game}/locations/{location}/parameters/{mode}', 'ConfigurerController@parameters')->name('configurer.parameters');
    Route::get('games/a/location/b/translate', 'ConfigurerController@translate')->name('configurer.translate');
});

Route::prefix('servers')->middleware(['auth'])->group(function () {
    Route::post('/', 'ServerController@store')->name('api.servers.store');
});
