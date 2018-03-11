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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::prefix('profile')->group(function () {
    Route::namespace('Profile')->group(function () {
        // Controllers Within The "App\Http\Controllers\Profile" Namespace
        Route::get('/', 'IndexController@index')
            ->name('profile.index');
        Route::get('/details/edit', 'IndexController@editDetails')
            ->name('profile.details.edit');
        Route::post('/details/update', 'IndexController@updateDetails')
            ->name('profile.details.update');
        Route::get('/account/edit', 'IndexController@editAccount')
            ->name('profile.account.edit');
        Route::post('/account/update', 'IndexController@updateAccount')
            ->name('profile.account.update');
    });
});