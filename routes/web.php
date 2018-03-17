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

Route::group(['namespace' => 'Frontend'], function(){
    Route::get('/properties', 'PropertiesController@index')->name('properties.index');
    Route::get('/property/{property}', 'PropertiesController@view')->name('property.view');
    

    Route::post('/booking/request', 'BookingController@requestToBook')->name('booking.request');
    Route::post('/booking/compute', 'BookingController@getBookingPrices')->name('booking.compute');
});


/**
 *  prefix = /profile/{route}
 *  namespace = Controllers Within The "App\Http\Controllers\Profile" Namespace
*/
Route::group( ['prefix'=>'profile', 'namespace' => 'Profile', 'middleware' => 'not.auth'], function (){
        
    Route::get('/', 'IndexController@index')->name('profile.index');
    Route::get('/details/edit', 'IndexController@editDetails')->name('profile.details.edit');
    Route::post('/details/update', 'IndexController@updateDetails')->name('profile.details.update');
    Route::get('/account/edit', 'IndexController@editAccount')->name('profile.account.edit');
    Route::post('/account/update', 'IndexController@updateAccount')->name('profile.account.update');
        
    Route::group(['middleware' => 'not.host'], function(){
        // 'as' => to define prefix to access 'profile.listings.{action}'
        Route::resource('properties', 'PropertyController', ['as' => 'profile']); 
    });
        
});

Route::group( ['prefix' => 'admin', 'namespace' => 'Admin'], function(){

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.loginform');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'not.admin'], function(){
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    });
});

Route::get('/{url_slug}', 'Frontend\PageController@index')->name('page');
