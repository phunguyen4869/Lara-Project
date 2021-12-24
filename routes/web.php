<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
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

//prefix url admin
Route::prefix('admin')->group(function () {

    //route to login page
    Route::get(
        'login',
        [LoginController::class, 'index']
    )->name('login');

    //post data to store function in LoginController
    Route::post(
        'login/store',
        [LoginController::class, 'store']
    );


    //middleware group
    Route::middleware('auth')->group(function () {
        //get route to dashboard page
        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        //menu routes
        Route::prefix('menus')->group(function () {
            //get route to show menu list
            Route::get(
                'list',
                [MenuController::class, 'index']
            )->name('menus.index');

            //get route to create menu page
            Route::get(
                'create',
                [MenuController::class, 'create']
            );
            //post route to store menu
            Route::post(
                'store',
                [MenuController::class, 'store']
            );
            //delete route to delete menu page
            Route::delete(
                'destroy',
                [MenuController::class, 'destroy']
            );
        });
    });
});

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
