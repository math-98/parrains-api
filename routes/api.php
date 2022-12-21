<?php

use App\Http\Controllers\FilleulController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ParrainageController;
use App\Http\Controllers\ParrainController;
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

Route::apiResources([
    'filleuls' => FilleulController::class,
    'parrains' => ParrainController::class,
], [
    'only' => ['index'],
]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResources([
        'filleuls' => FilleulController::class,
        'parrains' => ParrainController::class,
    ], [
        'except' => ['index', 'show'],
    ]);
    Route::post('filleuls/{filleul}/assign', [ParrainageController::class, 'update']);
    Route::apiResource('managers', ManagerController::class, [
        'except' => ['show'],
    ]);
});

Route::group([
    'prefix' => 'parrainages',
    'controller' => ParrainageController::class,
], function () {
    Route::get('/', 'index');
    Route::get('pdf', 'pdf');
    Route::post('attribution', 'api')->middleware('auth:sanctum');
});
