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
            "name_ar" => "required|string|max:255",
            "name_en" => "required|string|max:255",
            "email" => "nullable|email|max:255",
            "subject_ar" => "required|string|max:255",
            "subject_en" => "required|string|max:255", 
            "message_ar" => "required|string|max:1000",
            "message_en" => "required|string|max:1000",
        ]);
 
        // Add is_read and sent_at manually
        $validatedData['is_read'] = false;
        $validatedData['sent_at'] = Carbon::now();

        // Save contact
        Contact::create($validatedData);

        // Return success response
        return redirect()->route('contact')->with("success", "Your message has been sent. Thank you!");
    }
}
