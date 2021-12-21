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

Route::get('/lara-welcome', function () {
    return view('welcome');
});

// Route::get(
//     'admin/users/login',
//     [LoginController::class, 'index']
// );

//get route to login page
Route::get(
    '/admin/login',
    [LoginController::class, 'index']
);

//post data to store function in LoginController
Route::post(
    'admin/login/store',
    [LoginController::class, 'store']
);

Route::get(
    'admin/dashboard',
    [DashboardController::class, 'index']
)->name('admin.dashboard');
