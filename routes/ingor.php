<?php

use Illuminate\Support\Facades\Route;

Route::name('ingor.')->group(function () {

    // // Authentication Routes...
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login', 'Auth\LoginController@login')->name('login.send');
    // Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // // Ingor Main Routes...
    // Route::middleware('ingor.auth')->group(function () {
    //     Route::get('/', 'HomeController@index')->name('home');
    // });

    Route::get('/', 'HomeController@index')->name('home');

});
