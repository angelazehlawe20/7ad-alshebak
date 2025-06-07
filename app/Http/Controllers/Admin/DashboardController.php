<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MenuItem;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\View\View;
class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics
     *
     * @return View
     */
    public function index(): View
    {
        // إحضار عدد العناصر من قاعدة البيانات
        $statistics = [
            'menuItemsCount' => MenuItem::count(),
            'offersCount' => Offer::count(),
            'bookingsCount' => Booking::count(),
            'bookingsByStatus' => [
                'confirmed' => Booking::where('status', 'confirmed')->count(),
                'pending' => Booking::where('status', 'pending')->count(),
                'cancelled' => Booking::where('status', 'cancelled')->count(),
            ]
        ];

        return view('admin.dashboard', [
            'menuItemsCount' => $statistics['menuItemsCount'],
            'offersCount' => $statistics['offersCount'],
            'bookingsCount' => $statistics['bookingsCount'],
            'confirmedBookings' => $statistics['bookingsByStatus']['confirmed'],
            'pendingBookings' => $statistics['bookingsByStatus']['pending'],
            'cancelledBookings' => $statistics['bookingsByStatus']['cancelled']
        ]);
    }
}
