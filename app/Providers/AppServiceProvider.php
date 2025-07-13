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
        $settings = Setting::first();
        View::share('footer', $settings);
        View::share('settings', $settings);
        View::share('heroPage', Hero_Page::first());

        // Share notification counts with all admin views
        $unreadMessages = Contact::where('is_read', false)->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $admin = Auth::guard('admin')->user();

        View::share([
            'unreadMessagesCount' => $unreadMessages,
            'pendingBookingsCount' => $pendingBookings,
            'admin' => $admin,
        ]);
    }
}
