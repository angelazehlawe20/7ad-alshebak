<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Show the booking form
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view("partials.book");
    }

    /**
     * Store a new booking
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => ['required', 'regex:/^9\d{8}$/'],
            'guests_count' => 'required|integer|min:1|max:50',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i',
            'message' => 'nullable|string|max:1000',
        ]);

        $locale = app()->getLocale();

        $dataToSave = [
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'],
            'guests_count' => $validatedData['guests_count'],
            'booking_date' => $validatedData['booking_date'],
            'booking_time' => $validatedData['booking_time'],
            'status' => 'pending',
        ];

        if ($locale === 'ar') {
            $dataToSave['name_ar'] = $validatedData['name'];
            $dataToSave['message_ar'] = $validatedData['message'] ?? null;
            $dataToSave['name_en'] = null;
            $dataToSave['message_en'] = null;
        } else {
            $dataToSave['name_en'] = $validatedData['name'];
            $dataToSave['message_en'] = $validatedData['message'] ?? null;
            $dataToSave['name_ar'] = null;
            $dataToSave['message_ar'] = null;
        }

        $booking = Booking::create($dataToSave);

        // Send Telegram notification after booking
        try {
            $telegramToken = config('services.telegram.bot_token');
            $admins = Admin::whereNotNull('telegram_chat_id')
                            ->pluck('telegram_chat_id');

            if ($admins->isNotEmpty() && $telegramToken) {
                $message = "📅 *New Booking Received*\n\n";
                $message .= "👤 *Name:* " . $validatedData['name'] . "\n";
                $message .= "📞 *Phone:* +963" . $validatedData['phone'] . "\n";
                if (!empty($validatedData['email'])) {
                    $message .= "📧 *Email:* " . $validatedData['email'] . "\n";
                }
                $message .= "📅 *Date:* " . $validatedData['booking_date'] . "\n";
                $message .= "⏰ *Time:* " . $validatedData['booking_time'] . "\n";
                $message .= "👥 *Number of Guests:* " . $validatedData['guests_count'] . "\n";
                if (!empty($validatedData['message'])) {
                    $message .= "💬 *Message:* " . $validatedData['message'] . "\n";
                }

                foreach ($admins as $chatId) {
                    Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                        'chat_id' => $chatId,
                        'text' => $message,
                        'parse_mode' => 'Markdown',
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log the error but don't stop the booking process
            Log::error('Telegram notification failed: ' . $e->getMessage());
        }
        return redirect()->route('book')->with('success', __('book.booking_success'));
    }
}
