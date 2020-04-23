<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController')->name('home');

Route::resource('managers', 'ManagerController')->middleware('auth');

Route::resource('filleuls', 'FilleulController')->only('index');
Route::resource('parrains', 'ParrainController')->only('index');

Route::middleware('auth')->group(function () {
    Route::resource('filleuls', 'FilleulController')->except('index');
    Route::group(['prefix' => 'filleuls', 'as' => 'filleuls.'], function () {
        Route::get('import', 'FilleulController@getImport')->name('import');
        Route::post('import', 'FilleulController@postImport');
    });

    Route::resource('parrains', 'ParrainController')->except('index');
    Route::group(['prefix' => 'parrains', 'as' => 'parrains.'], function () {
        Route::get('import', 'ParrainController@import')->name('import');
        Route::post('import', 'ParrainController@postImport');
    });
});

Route::group(['prefix' => 'parrainages', 'as' => 'parrainages.'], function () {
    Route::get('/', 'ParrainageController@index')->name('index');

    Route::get('pdf', 'ParrainageController@pdf')->name('pdf');

    Route::middleware('auth')->group(function () {
        Route::get('{filleul}/assign', 'ParrainageController@assign')->name('assign');
        Route::post('{filleul}/assign', 'ParrainageController@update');

        Route::get('attribution', 'ParrainageController@attribution')->name('attribution');
        Route::post('attribution', 'ParrainageController@api');
    });
});

Auth::routes([
    'confirm' => false,
]);
