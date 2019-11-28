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

Route::get('/', "HomeController@index")->name('home');

Route::group(['prefix' => 'managers', 'as' => 'managers.', 'middleware' => 'auth'], function () {
    Route::get('/', "ManagerController@index")->name('index');

    Route::get('create', "ManagerController@create")->name('create');
    Route::post('create', "ManagerController@store");

    Route::get('{manager}/edit', "ManagerController@edit")->name('edit');
    Route::post('{manager}/edit', "ManagerController@update");

    Route::post('{manager}/delete', "ManagerController@destroy")->name('destroy');
});

Route::group(['prefix' => 'filleuls', 'as' => 'filleuls.'], function () {
    Route::get('/', "FilleulController@index")->name('index');

    Route::middleware('auth')->group(function () {
        Route::get('create', "FilleulController@create")->name('create');
        Route::post('create', "FilleulController@store");

        Route::get('{filleul}/edit', "FilleulController@edit")->name('edit');
        Route::post('{filleul}/edit', "FilleulController@update");

        Route::post('{filleul}/delete', "FilleulController@destroy")->name('destroy');
    });
});

Auth::routes([
    'confirm' => false,
    'register' => false,
    'reset' => false
]);
