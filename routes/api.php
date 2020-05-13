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
//    Route::get('game/{game}/locations', 'ConfigurerController@locations')->name('configurer.locations');
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
