<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\MainController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

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

        //category routes
        Route::prefix('categories')->group(function () {
            //route to show category list
            Route::get(
                'list',
                [CategoryController::class, 'index']
            )->name('categories.index');

            //route to create category
            Route::get(
                'create',
                [CategoryController::class, 'create']
            );
            //route to store category
            Route::post(
                'store',
                [CategoryController::class, 'store']
            );
            //delete route to delete category page
            Route::delete(
                'destroy',
                [CategoryController::class, 'destroy']
            );
            //edit route to edit category page
            Route::get(
                'edit/{category}',
                [CategoryController::class, 'edit']
            );
            //route to update category
            Route::post(
                'edit/{category}',
                [CategoryController::class, 'update']
            );
            //route to change category status
            Route::get(
                'changeStatus',
                [CategoryController::class, 'changeStatus']
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
            //route to edit product
            Route::get(
                'edit/{product}',
                [ProductController::class, 'show']
            );
            //route to update product
            Route::post(
                'edit/{product}',
                [ProductController::class, 'update']
            );
            //route to delete product
            Route::delete(
                'destroy',
                [ProductController::class, 'destroy']
            );
            //route to change product status
            Route::get(
                'changeStatus',
                [ProductController::class, 'changeStatus']
            );
        });

        //slider routes
        Route::prefix('sliders')->group(function () {
            //route to show slider list
            Route::get(
                'list',
                [SliderController::class, 'index']
            )->name('sliders.index');
            //route to create slider
            Route::get(
                'add',
                [SliderController::class, 'create']
            );
            //route to store slider
            Route::post(
                'add',
                [SliderController::class, 'store']
            );
            //route to edit slider
            Route::get(
                'edit/{slider}',
                [SliderController::class, 'show']
            );
            //route to update slider
            Route::post(
                'edit/{slider}',
                [SliderController::class, 'update']
            );
            //route to delete slider
            Route::delete(
                'destroy',
                [SliderController::class, 'destroy']
            );
        });

        //upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [MainController::class, 'index']);

//show product modal
Route::get('/productModal', [MainController::class, 'showProductModal']);

//load more products
Route::get('/loadmore', [MainController::class, 'loadMore']);

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
