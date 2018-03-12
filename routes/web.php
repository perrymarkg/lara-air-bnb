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


Route::group( ['prefix'=>'profile', 'namespace' => 'Profile', 'middleware' => 'not.auth'], function (){
        // prefix = /profile/{route}
        // namespace = Controllers Within The "App\Http\Controllers\Profile" Namespace
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

        // 'as' => to define prefix to access 'profile.listings.{action}'
        Route::resource('listings', 'ListingController', ['as' => 'profile']);
        /* Route::get('/listings', 'ListingController@index')
            ->name('profile.listings');
        Route::get('/listings/{listing}', 'ListingController@edit')
            ->name('profile.listings.edit'); */
});
/*
Route::prefix('profile')->group( function () {
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
*/