<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
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
            //route to show menu list
            Route::get(
                'list',
                [MenuController::class, 'index']
            )->name('menus.index');

            //route to create menu
            Route::get(
                'create',
                [MenuController::class, 'create']
            );
            //route to store menu
            Route::post(
                'store',
                [MenuController::class, 'store']
            );
            //delete route to delete menu page
            Route::delete(
                'destroy',
                [MenuController::class, 'destroy']
            );
            //edit route to edit menu page
            Route::get(
                'edit/{menu}',
                [MenuController::class, 'edit']
            );
            //route to update menu page
            Route::post(
                'edit/{menu}',
                [MenuController::class, 'update']
            );
        });

        //product routes
        Route::prefix('products')->group(function () {
            //route to show product list
            Route::get(
                'list',
                [ProductController::class, 'index']
            )->name('products.index');

            //route to create product
            Route::get(
                'add',
                [ProductController::class, 'create']
            );
            //route to store product
            Route::post(
                'add',
                [ProductController::class, 'store']
            );
            //delete route to delete product page
            Route::delete(
                'destroy',
                [ProductController::class, 'destroy']
            );
            //edit route to edit product page
            Route::get(
                'edit/{product}',
                [ProductController::class, 'edit']
            );
            //route to update product page
            Route::post(
                'edit/{product}',
                [ProductController::class, 'update']
            );
        });
    });
});

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
