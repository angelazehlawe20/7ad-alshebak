<?php

namespace App\Providers;

use App\Models\Hero_Page;
use App\Models\Setting;
use App\Models\Social_link;
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
        view()->composer('*', function ($view) {
            $view->with('footer', Setting::first());
        });
        View::composer('*', function ($view) {
            $view->with('settings', Setting::first());
        });
        View::composer('*', function ($view) {
            $view->with('heroPage', Hero_Page::first());
        });
    }
}
