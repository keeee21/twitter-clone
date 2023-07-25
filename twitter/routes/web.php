<?php

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

Route::get('/', [App\Http\Controllers\TopController::class, 'index'])->name('top');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/users/{id}',[App\Http\Controllers\UserController::class, 'findByUserId'])->name('users.findByUserId');
});
