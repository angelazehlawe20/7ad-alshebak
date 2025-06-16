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
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024'
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
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/settings'), $logoName);
            $settings->logo = $logoName;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = 'favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('uploads/settings'), $faviconName);
            $settings->favicon = $faviconName;
        }

        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
