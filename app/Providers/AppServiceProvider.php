<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Share the authenticated user instance with specific views
        View::composer(['dashboard.*', 'dashboard.products.*', 'dashboard.categories.*'], function ($view) {
            $view->with('user', Auth::user());
        });

        //this is how to make a custom validation
        Validator::extend('filter',function($attribute,$value,$params) {
            return ! in_array(strtolower($value),$params);
            /*if (strtolower($value) == 'laravel')
            {
                return false;
            }
            return true;
            */
        },"this value is not allowed!");

        Paginator::useBootstrapFive();
    }
}
