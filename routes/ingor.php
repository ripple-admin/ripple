<?php

use Illuminate\Support\Facades\Route;
use Ingor\Http\Controllers\Auth\LoginController;
use Ingor\Http\Controllers\HomeController;
use Ingor\Ingor;

Route::name('ingor.')->group(function () {

    // // Authentication Routes...
    // Route::get('login', [LoginController::class, '@showLoginForm'])->name('login');
    // Route::post('login', [LoginController::class, '@login'])->name('login.send');
    // Route::post('logout', [LoginController::class, '@logout'])->name('logout');

    // // Ingor Main Routes...
    // Route::middleware('ingor.auth')->group(function () {
    //     Route::get('/', [HomeController::class, 'index'])->name('home');
    // });

    // Route::get('/', [HomeController::class, 'index'])->name('home');

    Ingor::waterRoutes();
    Ingor::pluginRoutes();

});
