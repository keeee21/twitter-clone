<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\TweetController::class . '@index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('tweets', \App\Http\Controllers\TweetController::class);

Route::prefix('mypage')->group(function () {
    Route::get('/', [\App\Http\Controllers\UserProfileController::class, 'show'])->name('mypage.show');
    Route::put('/', [\App\Http\Controllers\UserProfileController::class, 'update'])->name('mypage.update');
    Route::delete('/', [\App\Http\Controllers\UserProfileController::class, 'destroy'])->name('mypage.destroy');
});
