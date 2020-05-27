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

// TODO: @deprecated
Route::prefix('cost')->group(function () {
    Route::get('creation', 'CostController@creation')->name('cost.creation');
    Route::get('deployment', 'CostController@deployment')->name('cost.deployment');
});

Route::prefix('configurer')->group(function () {
    Route::get('games', 'ConfigurerController@games')->name('configurer.games');
    Route::get('locations', 'ConfigurerController@locations')->name('configurer.locations');
    Route::get('games/{game}/locations', 'ConfigurerController@gameLocations')->name('configurer.gameLocations');
    Route::get('games/{game}/locations/{location}/specs/{mode}', 'ConfigurerController@specs')->name('configurer.specs');
    Route::get('games/a/location/b/translate', 'ConfigurerController@translate')->name('configurer.translate');
});

Route::prefix('servers')->middleware(['auth'])->group(function () {
    Route::post('/', 'ServerController@store')->name('api.servers.store');
});

Route::prefix('nodes')->group(function () {
    Route::get('location/{location}/cost', 'NodeController@cost')->name('servers.cost');
    Route::get('test', function () {
        return rand(0, 8000);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
