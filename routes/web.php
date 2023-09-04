<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\General\HomeController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'formLogin'])->name('form-login');
Route::post('/do-login', [LoginController::class, 'doLogin'])->name('do-login');
Route::get('/register', [RegisterController::class, 'formRegister'])->name('form-register');
Route::post('/do-register', [RegisterController::class, 'doRegister'])->name('do-register');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin::dashboard');
    Route::get('/user-active', [UserController::class, 'userActive'])->name('admin::user-active');
});
