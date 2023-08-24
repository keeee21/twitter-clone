<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TweetController;
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

Route::prefix('tweets')->group(function() {
    Route::get('/', [TweetController::class, 'index'])->name('tweets.index');
    Route::get('/create', [TweetController::class, 'create'])->name('tweets.create');
    Route::post('/', [TweetController::class, 'store'])->name('tweets.store');
    Route::get('/{tweet}', [TweetController::class, 'show'])->name('tweets.show');
    Route::get('/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');
});

Route::prefix('mypage')->group(function() {
    Route::get('/', [UserProfileController::class, 'index'])->name('mypage.index');
    Route::get('/{user}', [UserProfileController::class, 'show'])->name('mypage.show');
    Route::put('/{user}', [UserProfileController::class, 'update'])->name('mypage.update');
    Route::delete('/{user}', [UserProfileController::class, 'destroy'])->name('mypage.destroy');
});


