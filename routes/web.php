<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Users\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    'admin/users/login',
    [LoginController::class, 'index']
);

Route::post(
    'admin/users/login/store',
    [LoginController::class, 'store']
);

Route::get(
    'admin/dashboard',
    [DashboardController::class, 'index']
)->name('admin.dashboard');
