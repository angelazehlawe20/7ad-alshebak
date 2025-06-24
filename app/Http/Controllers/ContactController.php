<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("partials.contact");
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            "name_ar" => "nullable|string|max:255",
            "name_en" => "nullable|string|max:255",
            "email" => "nullable|email|max:255",
            "subject_ar" => "nullable|string|max:255",
            "subject_en" => "nullable|string|max:255",
            "message_ar" => "nullable|string|max:1000",
            "message_en" => "nullable|string|max:1000",
        ]);

        // Add is_read flag
        $validatedData['is_read'] = false;

        // Save contact
        Contact::create($validatedData);

        // Return success response
        return redirect()->route('contact')->with("success", "Your message has been sent. Thank you!");
    }
}
