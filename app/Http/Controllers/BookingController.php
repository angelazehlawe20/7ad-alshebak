<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        // ✅ إرسال إشعار تلغرام بعد الحفظ
        $telegramToken = config('services.telegram.bot_token'); // تأكد أنه موجود في ملف config/services.php
        $admins = Admin::whereIn('role', ['admin', 'owner'])
                        ->whereNotNull('telegram_chat_id')
                        ->pluck('telegram_chat_id');

        $message = "📅 حجز جديد تم:\n\n";
        $message .= "👤 الاسم: " . $validatedData['name'] . "\n";
        $message .= "📞 الهاتف: +963" . $validatedData['phone'] . "\n";
        $message .= "📅 التاريخ: " . $validatedData['booking_date'] . "\n";
        $message .= "⏰ الوقت: " . $validatedData['booking_time'] . "\n";
        $message .= "👥 عدد الأشخاص: " . $validatedData['guests_count'] . "\n";
        if (!empty($validatedData['message'])) {
            $message .= "💬 رسالة: " . $validatedData['message'] . "\n";
        }

        foreach ($admins as $chatId) {
            Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        }

        return redirect()->route('book')->with('success', __('book.booking_success'));
    }


}
