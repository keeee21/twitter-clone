<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {return view('welcome');})->name('Welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('users/{id}', [UserController::class, 'findByUserId'])->name('show');
    Route::get('users/', [UserController::class, 'getAll'])->name('index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
