<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
{
    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
    return view('admin.settings.index', compact('settings'));
}

public function update(Request $request)
{
    $request->validate([
        'site_name'     => 'nullable|string|max:255',
        'contact_email' => 'nullable|email',
        'phone_number'  => 'nullable|string|max:20',
        'about_ar'      => 'nullable|string',
        'about_en'      => 'nullable|string',
    ]);

    // حفظ القيم في قاعدة البيانات
    Setting::set('site_name', $request->site_name);
    Setting::set('contact_email', $request->contact_email);
    Setting::set('phone_number', $request->phone_number);
    Setting::set('about_ar', $request->about_ar);
    Setting::set('about_en', $request->about_en);

    return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
}

}
