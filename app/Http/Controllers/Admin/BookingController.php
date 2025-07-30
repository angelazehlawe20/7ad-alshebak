<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsByDateExport;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookingController extends Controller
{
    /**
     * عرض قائمة الحجوزات مع الفلاتر.
     */
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('status') && in_array($request->status, ['pending', 'confirmed', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->has('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        $bookings = $query->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * تصدير الحجوزات حسب نطاق التاريخ.
     */
    public function exportByDateRange(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $from = $request->from_date;
        $to = $request->to_date;

        $fileName = "bookings_from_{$from}_to_{$to}.xlsx";

        return Excel::download(new BookingsByDateExport($from, $to), $fileName);
    }

    /**
     * تحديث حالة الإشعار للحجوزات الجديدة.
     */
    public function markAsNotified()
    {
        Booking::where('status', 'pending')
            ->whereDate('created_at', now())
            ->where('is_notified', false)
            ->update(['is_notified' => true]);
    }

    /**
     * تحميل قائمة الحجوزات بصيغة HTML (AJAX).
     */
    public function getBookingsList()
    {
        $bookings = Booking::latest()->get();
        $pendingCount = Booking::where('status', 'pending')->count();

        $html = view('admin.bookings.booking_list', ['bookings' => $bookings])->render();

        return response()->json([
            'html' => $html,
            'pending_count' => $pendingCount
        ]);
    }

    /**
     * تحديث بيانات الحجز.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:13',
            'email' => 'sometimes|required|email|max:255',
            'guests_count' => 'sometimes|required|integer|min:1',
            'booking_date' => 'sometimes|required|date',
            'booking_time' => 'sometimes|required|date_format:h:i a',
            'message' => 'sometimes|nullable|string',
            'status' => 'sometimes|required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', __('book.update_message'));
    }

    /**
     * جلب الحجوزات المعلقة وعددها (AJAX).
     */
    public function getPendingBookings()
    {
        $pendingCount = Booking::where('status', 'pending')
            ->where('is_notified', false)
            ->count();

        return response()->json([
            'pending_count' => $pendingCount
        ]);
    }
}
