<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MenuItem;
use App\Models\Offer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // إحضار عدد العناصر من قاعدة البيانات
        $menuItemsCount = MenuItem::count();
        $offersCount = Offer::count();
        $bookingsCount = Booking::count();

        return view('admin.dashboard', compact('menuItemsCount', 'offersCount', 'bookingsCount'));
    }
}
