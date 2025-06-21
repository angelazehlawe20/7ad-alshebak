<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'email' => 'required|email|unique:settings,email,' . Setting::first()?->id,
            'phone' => 'nullable|string|max:10',
            'opening_hours' => 'nullable|string',
            'facebook_url' => 'nullable|string|url',
            'instagram_url' => 'nullable|string|url',
            'whatsapp' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|mimes:ico,png,jpg|max:1024'
        ]);

        $settings = Setting::firstOrNew();

        $settings->address = $request->address;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->opening_hours = $request->opening_hours;
        $settings->facebook_url = $request->facebook_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->whatsapp = $request->whatsapp;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo && file_exists(public_path('images/settings/' . $settings->logo))) {
                unlink(public_path('images/settings/' . $settings->logo));
            }
        
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Create directory if it doesn't exist
            if (!file_exists(public_path('images/settings'))) {
                mkdir(public_path('images/settings'), 0755, true);
            }
            $file->move(public_path('images/settings'), $filename);
            $settings->logo = $filename;
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon && file_exists(public_path('images/settings/' . $settings->favicon))) {
                unlink(public_path('images/settings/' . $settings->favicon));
            }
        
            $file = $request->file('favicon');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Create directory if it doesn't exist
            if (!file_exists(public_path('images/settings'))) {
                mkdir(public_path('images/settings'), 0755, true);
            }
            $file->move(public_path('images/settings'), $filename);
            $settings->favicon = $filename;
        }

        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
