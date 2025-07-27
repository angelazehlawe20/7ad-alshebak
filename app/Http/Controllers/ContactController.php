<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
            "name" => "nullable|string|max:255",
            "email" => "nullable|email|max:255",
            "subject" => "nullable|string|max:255",
            "message" => "nullable|string",
        ]);

        $validatedData['is_read'] = false;

        // Save contact
        $contact = Contact::create($validatedData);


        // Return success response
        return redirect()->route('contact')->with("success", __('contact.sent_message'));
    }
}
