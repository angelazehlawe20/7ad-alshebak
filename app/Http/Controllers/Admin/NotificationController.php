<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Get counts of unnotified pending bookings and unread messages
     *
     * @return JsonResponse
     */
    public function counters(): JsonResponse
    {
        // الحجوزات المعلقة
        $pendingBookings = Booking::where('status', 'pending')->latest()->get();

        // الرسائل غير المقروءة
        $unreadMessages = Contact::where('is_read', false)->latest()->get();

        // إشعارات الرسائل (أحدث 5 غير مُعلنة)
        $notificationsMessages = $unreadMessages->where('is_notified', false)->take(5)->map(function ($msg) {
            return [
                'id' => $msg->id,
                'type' => 'message',
                'name' => $msg->name,
                'message' => \Illuminate\Support\Str::limit(strip_tags($msg->message), 40),
                'time' => $msg->created_at->diffForHumans(),
            ];
        });

        // إشعارات الحجوزات (أحدث 5 غير مُعلنة)
        $notificationsBookings = $pendingBookings->where('is_notified', false)->take(5)->map(function ($booking) {
            return [
                'id' => $booking->id,
                'type' => 'booking',
                'name' => $booking->name,
                'phone' => $booking->phone,
                'date' => $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') : __('messages.no_date'),
                'time' => $booking->booking_time,
                'people' => $booking->guests_count,
                'notes' => \Illuminate\Support\Str::limit(strip_tags($booking->message), 40),
                'created' => $booking->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'pending_bookings' => $pendingBookings->count(),
            'unread_messages' => $unreadMessages->count(),
            'total' => $pendingBookings->where('is_notified', false)->count()
                + $unreadMessages->where('is_notified', false)->count(),
            'messages' => $notificationsMessages,
            'bookings' => $notificationsBookings,
        ]);
    }
}
