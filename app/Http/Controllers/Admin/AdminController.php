<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /*public function index()
    {
        return view("admin.admin_profile.index");
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:admins,name,' . $admin->id,
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|confirmed|min:6'
        ]);

        // تحقق من كلمة المرور القديمة إن وُجدت كلمة مرور جديدة
        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $admin->password)) {
                return back()->withErrors(['old_password' => 'كلمة المرور القديمة غير صحيحة.']);
            }

            $admin->password = Hash::make($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.profile.index')->with('success', 'تم تحديث البيانات بنجاح.');
    }*/
}
