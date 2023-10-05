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

Route::get('/home', [HomeController::class, 'home'])->name('home');

//ユーザー認証
Route::group(['middleware' => 'auth'], function () {
    //ユーザー詳細（プロフィール）表示
    Route::get('detail/{id}', [UserController::class, 'detail'])->name('detail');
    //編集ページ表示
    Route::get('edit', [UserController::class, 'edit'])->name('edit');
    //ユーザー情報編集
    Route::put('update', [UserController::class, 'update'])->name('update');
    //ユーザー削除
    Route::delete('delete',[UserController::class, 'delete'])->name('delete');
    //ユーザー一覧
    Route::get('index', [UserController::class, 'index'])->name('index');
});
