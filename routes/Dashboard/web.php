<?php

use \Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::prefix('dashboard')->middleware('auth')->group(function () {

        Route::get('/index','DashboardController@index')->name('dashboard.index');
        Route::resource('users','UserController')->except('show');
        Route::resource('categories','CategoryController')->except('show');
        Route::resource('products','ProductController')->except('show');

    });
});

