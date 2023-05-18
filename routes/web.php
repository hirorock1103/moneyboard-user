<?php

use App\Http\Middleware\BasicAuthMiddleware;

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


if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === "money-board-user.amb-dev.com") {
    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*');
} else {
    Route::get('/{any}', function () {
        return view('app');
    })->where('any', '.*')->middleware('basicauth');
}

// Route::group(['middleware' => 'basicauth'], function () {
//     Route::get('/{any}', function () {
//         return view('app');
//     })->where('any', '.*')->middleware('basicauth');
// });
