<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\CategoryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['header', 'home', 'footer'],
            CategoryComposer::class
        );

        View::composer(
            ['header', 'cart'],
            CartComposer::class
        );
    }
}
