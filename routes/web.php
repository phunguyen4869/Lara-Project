<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;

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

    //route to register page
    Route::get(
        'register',
        [RegisterController::class, 'index']
    );

    //post data to store function in RegisterController
    Route::post(
        'register/store',
        [RegisterController::class, 'store']
    );


    //middleware group
    Route::middleware('auth')->group(function () {
        //get route to dashboard page
        Route::get(
            'dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        //route to user page
        Route::prefix('user')->group(function () {
            Route::middleware('role:admin')->group(function () {
                Route::prefix('roles')->group(function () {
                    Route::get(
                        'list',
                        [UserController::class, 'rolesList']
                    );

                    Route::get(
                        'add',
                        [UserController::class, 'roleCreate']
                    );

                    Route::post(
                        'add',
                        [UserController::class, 'roleStore']
                    );

                    Route::get(
                        'edit/{id}',
                        [UserController::class, 'roleEdit']
                    );

                    Route::post(
                        'edit/{id}',
                        [UserController::class, 'roleUpdate']
                    );

                    Route::delete(
                        'destroy',
                        [UserController::class, 'roleDestroy']
                    );
                });
            });

            Route::middleware('permission:show user')->group(function () {
                //get route to user page
                Route::get(
                    'list',
                    [UserController::class, 'index']
                );
            });

            Route::middleware('permission:create user')->group(function () {
                Route::get(
                    'add',
                    [UserController::class, 'create']
                );

                Route::post(
                    'add',
                    [UserController::class, 'store']
                );
            });

            Route::middleware('permission:edit user')->group(function () {
                //get route to edit user page
                Route::get(
                    'edit/{user}',
                    [UserController::class, 'edit']
                );

                //post data to update function in UserController
                Route::post(
                    'edit/{user}',
                    [UserController::class, 'update']
                );
            });

            Route::middleware('permission:delete user')->group(function () {
                //get route to delete user page
                Route::delete(
                    'destroy',
                    [UserController::class, 'destroy']
                );
            });
        });

        //category routes
        Route::prefix('categories')->group(function () {
            Route::middleware('permission:show category')->group(function () {
                //route to show category list
                Route::get(
                    'list',
                    [CategoryController::class, 'index']
                )->name('categories.index');
            });

            Route::middleware('permission:create category')->group(function () {
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
            });

            Route::middleware('permission:edit category')->group(function () {
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
            });

            Route::middleware('permission:delete category')->group(function () {
                //delete route to delete category page
                Route::delete(
                    'destroy',
                    [CategoryController::class, 'destroy']
                );
            });

            Route::middleware('role:admin', 'role:moderator')->group(function () {
                //route to change category status
                Route::get(
                    'changeStatus',
                    [CategoryController::class, 'changeStatus']
                );
            });
        });

        //product routes
        Route::prefix('products')->group(function () {
            Route::middleware('permission:show product')->group(function () {
                //route to show product list
                Route::get(
                    'list',
                    [ProductController::class, 'index']
                );
            });

            Route::middleware('permission:create product')->group(function () {
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
            });

            Route::middleware('permission:edit product')->group(function () {
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
            });

            Route::middleware('role:admin', 'role:moderator')->group(function () {
                //route to change product status
                Route::get(
                    'changeStatus',
                    [ProductController::class, 'changeStatus']
                );
            });

            Route::middleware('permission:delete product')->group(function () {
                //route to delete product
                Route::delete(
                    'destroy',
                    [ProductController::class, 'destroy']
                );
            });
        });

        //slider routes
        Route::prefix('sliders')->group(function () {
            Route::middleware('permission:show slider')->group(function () {
                //route to show slider list
                Route::get(
                    'list',
                    [SliderController::class, 'index']
                )->name('sliders.index');
            });

            Route::middleware('permission:create slider')->group(function () {
                //route to create slider
                Route::get(
                    'add',
                    [SliderController::class, 'create']
                );

                //route to store new slider
                Route::post(
                    'add',
                    [SliderController::class, 'store']
                );
            });

            Route::middleware('permission:edit slider')->group(function () {
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
            });

            Route::middleware('permission:delete slider')->group(function () {
                //route to delete slider
                Route::delete(
                    'destroy',
                    [SliderController::class, 'destroy']
                );
            });

            Route::middleware('role:admin', 'role:moderator')->group(function () {
                //route to change slider status
                Route::get(
                    'changeStatus',
                    [SliderController::class, 'changeStatus']
                );
            });
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

//category page
Route::get('/category/{id}-{slug}', [MainCategoryController::class, 'index']);

//product detail page
Route::get('product/{id}-{slug}', [MainController::class, 'showProductDetail']);

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
