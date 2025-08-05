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
        $pendingBookings = Booking::where('status', 'pending')->latest()->get();
        $unreadMessages = Contact::where('is_read', false)->latest()->get();

        return response()->json([
            'pending_bookings' => $pendingBookings->count(),
            'unread_messages' => $unreadMessages->count(),
            'bell_pending_bookings' => $pendingBookings->where('is_notified', false)->count(),
            'bell_unread_messages' => $unreadMessages->where('is_notified', false)->count(),
            'notifications' => [
                'bookings' => $pendingBookings->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'name' => $booking->name,
                        'created_at_diff' => $booking->created_at->diffForHumans(),
                        'created_at' => $booking->created_at->toISOString(),
                        'is_new' => !$booking->is_notified
                    ];
                }),
                'messages' => $unreadMessages->map(function ($message) {
                    return [
                        'id' => $message->id,
                        'sender_name' => $message->name,
                        'content' => $message->message,
                        'created_at_diff' => $message->created_at->diffForHumans(),
                        'is_read' => $message->is_read,
                        'created_at' => $message->created_at->toISOString(),
                        'is_new' => !$message->is_notified,
                    ];
                })
            ]
        ]);
    }
}
