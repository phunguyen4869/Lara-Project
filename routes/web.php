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

//route to login page
Route::get(
    'admin/',
    [LoginController::class, 'index']
)->name('login');

//post data to store function in LoginController
Route::post(
    '/login/store',
    [LoginController::class, 'store']
);

//middleware group
Route::middleware('auth')->group(function () {
    //get route to dashboard page
    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('admin');
    //logout route
    Route::get(
        '/logout',
        [LoginController::class, 'logout']
    )->name('logout');
});

//Menu routes
Route::prefix('menus')->group(function () {
    
});
