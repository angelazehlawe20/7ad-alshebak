<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'البيانات المدخلة غير صحيحة.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form');
    }

    public function index()
    {
        return view("admin.admin_profile.index");
    }

    public function update(Request $request, Admin $admin)
    {
        // Ensure the admin can only update their own profile unless they are an owner
        if ($admin->id !== auth()->guard('admin')->id() && !auth()->guard('admin')->user()->is_owner) {
            abort(403, 'Unauthorized action.');
        }

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
    }
}
