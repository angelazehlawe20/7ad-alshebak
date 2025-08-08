<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $notificationsMessages = $unreadMessages->where('is_notified', false)->take(50)->map(function ($msg) {
            return [
                'id' => $msg->id,
                'type' => 'message',
                'name' => $msg->name,
                'message' => \Illuminate\Support\Str::limit(strip_tags($msg->message), 40),
                'time' => $msg->created_at->diffForHumans(),
            ];
        });

        $notificationsBookings = $pendingBookings->where('is_notified', false)->take(50)->map(function ($booking) {
            return [
                'id' => $booking->id,
                'type' => 'booking',
                'name' => $booking->name,
                'phone' => $booking->phone,
                'date' => $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') : __('messages.no_date'),
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

    public function markAsNotified(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');

        if ($type === 'booking') {
            $booking = \App\Models\Booking::find($id);
            if ($booking) {
                $booking->is_notified = true;
                $booking->save();
            }
        } elseif ($type === 'contact') {
            $contact = \App\Models\Contact::find($id);
            if ($contact) {
                $contact->is_notified = true;
                $contact->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
