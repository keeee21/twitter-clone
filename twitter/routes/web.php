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
    // ユーザー詳細（プロフィール）表示
    Route::get('users/{id}', [UserController::class, 'findByUserId'])->name('show');
    //編集ページ表示
    Route::get('edit', [UserController::class, 'editProfile'])->name('editProfile');
    //ユーザー情報編集
    Route::put('edit', [UserController::class, 'update'])->name('edit');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
