<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\FilleulController;
use App\Http\Controllers\ManagerController;
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
    Route::apiResource('managers', ManagerController::class, [
        'except' => ['show'],
    ]);
});

Route::group([
    'prefix' => 'export',
    'controller' => ExportController::class,
], function () {
    Route::get('pdf', 'pdf');
});
