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
    public function getCount(): JsonResponse
    {
        // الحصول على الحجوزات المعلقة غير المُعلنة
        $pendingBookings = Booking::where('status', 'pending')
            ->where('is_notified', false)
            ->latest()
            ->take(5)
            ->get();

        // الحصول على الرسائل غير المقروءة وغير المُعلنة
        $unreadMessages = Contact::where('is_read', false)
            ->where('is_notified', false)
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'pending_bookings' => $pendingBookings->count(),
            'unread_messages' => $unreadMessages->count(),
            'notifications' => [
                'bookings' => $pendingBookings->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'name' => $booking->name,
                        'service_type' => $booking->service_type,
                        'created_at_diff' => $booking->created_at->diffForHumans()
                    ];
                }),
                'messages' => $unreadMessages->map(function ($message) {
                    return [
                        'id' => $message->id,
                        'name' => $message->name,
                        'message' => $message->message,
                        'created_at_diff' => $message->created_at->diffForHumans()
                    ];
                })
            ]
        ]);
    }
}
