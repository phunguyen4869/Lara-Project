<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
use App\Http\Controllers\CartController;

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

    //route to verify email notice
    Route::get('/email/verify', function () {
        return view('admin.users.verify-email', [
            'title' => 'Verify Email',
        ]);
    })->middleware('auth')->name('verification.notice');

    //route to verify email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/admin/dashboard')->with('status', 'Your e-mail is verified!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    //route to resend email verification
    Route::post('email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('forgot-password', function () {
        return view(
            'admin.users.forgot-password',
            [
                'title' => 'Forgot Password',
            ]
        );
    })->middleware('guest')->name('password.request');

    Route::post('forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view(
            'admin.users.reset-password',
            ['title' => 'Reset Password', 'token' => $token]
        );
    })->middleware('guest')->name('password.reset');

    Route::post('reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');

    //middleware group
    Route::middleware(['auth', 'verified'])->group(function () {
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

            Route::prefix('payment')->group(function () {
                Route::middleware('permission:edit payment')->group(function () {
                    Route::get(
                        'list',
                        [UserController::class, 'paymentList']
                    );
                    Route::get(
                        'edit/{user}',
                        [UserController::class, 'paymentEdit']
                    );

                    Route::post(
                        'edit/{user}',
                        [UserController::class, 'paymentUpdate']
                    );
                });

                Route::middleware('permission:delete payment')->group(function () {
                    Route::delete(
                        'destroy',
                        [UserController::class, 'paymentDestroy']
                    );
                });
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

            Route::middleware('role:admin|moderator')->group(function () {
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

            Route::middleware('role:admin|moderator')->group(function () {
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

            Route::middleware('role:admin|moderator')->group(function () {
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
Route::get('productModal', [MainController::class, 'showProductModal']);

//load more products
Route::get('loadmore', [MainController::class, 'loadMore']);

//category page
Route::get('category/{id}-{slug}', [MainCategoryController::class, 'index']);

//product detail page
Route::get('product/{id}-{slug}', [MainController::class, 'showProductDetail']);

//add product to cart
Route::post('addToCart', [CartController::class, 'addToCart']);

//change product quantity
Route::get('updateCart', [CartController::class, 'updateCart']);

//remove product from cart
Route::get('removeProduct', [CartController::class, 'removeProduct']);

//show cart
Route::get('cart', [CartController::class, 'showCart']);

//check out
Route::get('checkout', [CartController::class, 'checkOut']);

Route::post('checkout', [CartController::class, 'sendOrder']);

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
