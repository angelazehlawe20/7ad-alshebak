<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Hero_Page;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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

        // Share notification counts with all admin views
        View::composer('admin.*', function ($view) {
            $unreadMessages = Contact::where('is_read', false)->count();
            $pendingBookings = Booking::where('status', 'pending')->count();

             // الحصول على الأدمن الحالي
        $admin = Auth::guard('admin')->user();

            $view->with([
                'unreadMessagesCount' => $unreadMessages,
                'pendingBookingsCount' => $pendingBookings,
                'admin' => $admin,
            ]);
        });
    }
}
