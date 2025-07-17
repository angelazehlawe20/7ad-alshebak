<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Events\NewBookingEvent;
use App\Notifications\NewBookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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

        $dataToSave = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'] ?? null,
            'phone' => $validatedData['phone'],
            'guests_count' => $validatedData['guests_count'],
            'booking_date' => $validatedData['booking_date'],
            'booking_time' => $validatedData['booking_time'],
            'message' => $validatedData['message'] ?? null,
            'status' => 'pending',
        ];

        $booking = Booking::create($dataToSave);
        // Broadcast the new booking event
        broadcast(new NewBookingEvent($booking))->toOthers();

        // Send push notification to all admins
        $admins = Admin::all();
        Notification::send($admins, new NewBookingNotification($booking));

        // Send Telegram notification after booking using cURL
        try {
            // Get API key from config or use fallback
            $telegramToken = '7631986001:AAH82dKw0hXkyJ-REtZl2A2tmmK7me-oDaU';
            if (!$telegramToken) {
                return response()->json(['success' => false, 'message' => 'Telegram API Key is not set'], 400);
            }

            $channel = '@hadAlshubak';
            if (!$channel) {
                return response()->json(['success' => false, 'message' => 'Telegram Channel ID is not set'], 400);
            }
            // For backward compatibility, also check admins with telegram_chat_id
            $admins = Admin::whereNotNull('telegram_chat_id')->pluck('telegram_chat_id');

            // Prepare message
            $message = __('book.telegram_message', [
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'] ?? '-',
                'date' => $validatedData['booking_date'],
                'time' => $validatedData['booking_time'],
                'guests' => $validatedData['guests_count'],
                'message' => $validatedData['message'] ?? '-',
            ]);

            // Send to channel first
            $this->sendTelegramMessage($telegramToken, $channel, $message);

            // Then send to individual admins if available
            if ($admins->isNotEmpty()) {
                foreach ($admins as $chatId) {
                    $this->sendTelegramMessage($telegramToken, $chatId, $message);
                }
            }
        } catch (\Exception $e) {
            Log::error('Telegram notification failed: ' . $e->getMessage());
        }

        return redirect()->route('book')->with('success', __('book.booking_success'));
    }

    /**
     * Send a message to Telegram using cURL
     *
     * @param string $apiKey The Telegram Bot API key
     * @param string $chatId The chat ID or channel name to send the message to
     * @param string $message The message to send
     * @return bool Success status
     */
    private function sendTelegramMessage($apiKey, $chatId, $message)
    {
        if (!$apiKey || !$chatId) {
            Log::error('Telegram API Key or Chat ID is not set');
            return false;
        }

        $url = "https://api.telegram.org/bot{$apiKey}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        if (!function_exists('curl_init')) {
            Log::error('cURL is not enabled on this server');
            return false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        $telegram_status = false;
        if ($http_code === 200) {
            $decoded_response = json_decode($response, true);
            if (isset($decoded_response['ok']) && $decoded_response['ok'] === true) {
                $telegram_status = true;
            }
        } else {
            Log::error('Telegram notification failed: ' . $error);
        }

        return $telegram_status;
    }
}
