<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
            'email' => 'required|email|unique:settings,email,' . Setting::first()?->id,
            'phone' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'facebook_url' => 'nullable|string|url',
            'instagram_url' => 'nullable|string|url',
            'whatsapp' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'favicon' => 'nullable|mimes:ico,png,jpg'
        ]);

        $settings = Setting::firstOrNew();

        $settings->address_ar = $request->address_ar;
        $settings->address_en = $request->address_en;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->opening_hours = $request->opening_hours;
        $settings->facebook_url = $request->facebook_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->whatsapp = $request->whatsapp;

        // ✅ شعار اللوغو
        if ($request->hasFile('logo')) {
            if ($settings->logo && File::exists(public_path($settings->logo))) {
                File::delete(public_path($settings->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = 'images/settings/logo/';
            $file->move(public_path($destination), $filename);
            $settings->logo = $destination . $filename;
        } elseif (!$settings->logo) {
            // إذا لا يوجد سابقًا شعار، عين مسار افتراضي
            $settings->logo = 'assets/img/logos/web-app-manifest-512x512.png';
        }

        // ✅ أيقونة الفافيكون
        if ($request->hasFile('favicon')) {
            if ($settings->favicon && File::exists(public_path($settings->favicon))) {
                File::delete(public_path($settings->favicon));
            }

            $file = $request->file('favicon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = 'images/settings/favicon/';
            $file->move(public_path($destination), $filename);
            $settings->favicon = $destination . $filename;
        } elseif (!$settings->favicon) {
            // إذا لا يوجد سابقًا فافيكون، عين مسار افتراضي
            $settings->favicon = 'assets/img/favicons/favicon.ico';
        }

        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', __('settings.updated_message'));
    }
}
