<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\MenuItem;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get counts for dashboard stats
        $totalMenuItems = MenuItem::count();
        $activeOffers = Offer::where('active', true)->count();
        $todayBookings = Booking::whereDate('created_at', today())->count();
        $unreadMessages = Contact::where('is_read', false)->count();

        // Get recent bookings
        $recentBookings = Booking::latest()
            ->take(5)
            ->get();

        // Get recent messages
        $recentMessages = Contact::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMenuItems',
            'activeOffers',
            'todayBookings',
            'unreadMessages',
            'recentBookings',
            'recentMessages'
        ));
    }

    public function menu()
    {
        $menuItems = MenuItem::paginate(10);
        return view('admin.menu.index', compact('menuItems'));
    }

    public function storeMenuItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:starters,breakfast,lunch,dinner',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu-items', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        $validated['active'] = $request->has('active');

        MenuItem::create($validated);

        return redirect()->route('admin.menu')
            ->with('success', 'Menu item created successfully.');
    }

    public function updateMenuItem(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:starters,breakfast,lunch,dinner',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menuItem->image && Storage::disk('public')->exists(str_replace('storage/', '', $menuItem->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $menuItem->image));
            }

            $imagePath = $request->file('image')->store('menu-items', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        $validated['active'] = $request->has('active');

        $menuItem->update($validated);

        return redirect()->route('admin.menu')
            ->with('success', 'Menu item updated successfully.');
    }

    public function deleteMenuItem(MenuItem $menuItem)
    {
        // Delete the image file
        if ($menuItem->image && Storage::disk('public')->exists(str_replace('storage/', '', $menuItem->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $menuItem->image));
        }

        $menuItem->delete();

        return response()->json(['success' => true]);
    }

    public function offers()
    {
        $offers = Offer::paginate(10);
        return view('admin.offers.index', compact('offers'));
    }


    public function bookings()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function contacts()
    {
        $messages = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('messages'));
    }
}
