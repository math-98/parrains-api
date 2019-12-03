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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'managers', 'as' => 'managers.', 'middleware' => 'auth'], function () {
    Route::get('/', 'ManagerController@index')->name('index');

    Route::get('create', 'ManagerController@create')->name('create');
    Route::post('create', 'ManagerController@store');

    Route::get('{manager}/edit', 'ManagerController@edit')->name('edit');
    Route::post('{manager}/edit', 'ManagerController@update');

    Route::post('{manager}/delete', 'ManagerController@destroy')->name('destroy');
});

Route::group(['prefix' => 'filleuls', 'as' => 'filleuls.'], function () {
    Route::get('/', 'FilleulController@index')->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('create', 'FilleulController@create')->name('create');
        Route::post('create', 'FilleulController@store');

        Route::get('import', 'FilleulController@getImport')->name('import');
        Route::post('import', 'FilleulController@postImport');

        Route::get('{filleul}/edit', 'FilleulController@edit')->name('edit');
        Route::post('{filleul}/edit', 'FilleulController@update');

        Route::post('{filleul}/delete', 'FilleulController@destroy')->name('destroy');
    });
});

Route::group(['prefix' => 'parrains', 'as' => 'parrains.'], function () {
    Route::get('/', 'ParrainController@index')->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('create', 'ParrainController@create')->name('create');
        Route::post('create', 'ParrainController@store');

        Route::get('import', 'ParrainController@getImport')->name('import');
        Route::post('import', 'ParrainController@postImport');

        Route::get('{parrain}/edit', 'ParrainController@edit')->name('edit');
        Route::post('{parrain}/edit', 'ParrainController@update');

        Route::post('{parrain}/delete', 'ParrainController@destroy')->name('destroy');
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
    'reset' => false,
]);
