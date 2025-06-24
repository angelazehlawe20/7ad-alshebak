<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

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

    Booking::create($dataToSave);

    return redirect()->route('book')->with('success', __('book.booking_success'));
}

}
