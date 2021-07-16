<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/down', function () {
    Artisan::call('down --secret=');
    return 'Application is now in maintenance mode';
});

Route::get('/up', function () {
     Artisan::call('up');
    return 'Application is now live';
});
