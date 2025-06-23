<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        try {
            // Validate the request data
            $validatedData = $request->validate([
                "name_ar" => "required|string|max:255",
                "name_en" => "required|string|max:255", 
                "email" => "nullable|email|max:255",
                "phone" => "required|regex:/^9\d{8}$/",
                "guests_count" => "required|integer|min:1|max:50",
                "booking_date" => "required|date|after:today",
                "booking_time" => "required|date_format:H:i",
                "message_ar" => "nullable|string|max:1000",
                "message_en" => "nullable|string|max:1000",
            ]);

            // Add status field 
            $validatedData['status'] = 'pending';

            // Save booking
            $booking = Booking::create($validatedData);

            // Log success
            Log::info('New booking created', ['booking_id' => $booking->id]);

            // Redirect back with success
            return redirect()
                ->route("book")
                ->with("success", "Your booking has been successfully created! We will contact you soon.");
        } catch (\Exception $e) {
            // Log the error
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->except(['_token']),
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect back with error
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Sorry, there was a problem creating your booking. Please try again.");
        }
    }
}
