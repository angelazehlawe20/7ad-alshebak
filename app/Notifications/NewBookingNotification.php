<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewBookingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->booking->id,
            'name' => $this->booking->name,
            'guests_count' => $this->booking->guests_count,
            'booking_date' => $this->booking->booking_date,
            'booking_time' => $this->booking->booking_time,
            'status' => $this->booking->status,
            'message' => "New booking request from {$this->booking->name}"
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->booking->id,
            'name' => $this->booking->name,
            'guests_count' => $this->booking->guests_count,
            'booking_date' => $this->booking->booking_date,
            'booking_time' => $this->booking->booking_time,
            'status' => $this->booking->status,
            'message' => "New booking request from {$this->booking->name}"
        ]);
    }
}