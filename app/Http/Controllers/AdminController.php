<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;  // نموذج الـ Admin
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // عرض بيانات الـ admin الحالي
    /*public function show()
    {
        // نفترض أن الـ admin مسجل دخوله
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.show', compact('admin'));
    }

    // صفحة تعديل بيانات الـ admin
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', compact('admin'));
    }

    // تحديث بيانات الـ admin
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // تحقق من البيانات المدخلة
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:admins,email,{$admin->id}",
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }*/
}
