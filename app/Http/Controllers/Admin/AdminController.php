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
            'email' => __('validation.invalid_data'),
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
        // السماح فقط بتعديل الحساب الشخصي أو في حال كان المستخدم مالكًا للنظام
        if ($admin->id !== auth()->guard('admin')->id() && !auth()->guard('admin')->user()->is_owner) {
            abort(403, __('errors.unauthorized'));
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255' . $admin->id,
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|confirmed|min:6'
        ]);

        // تحقق من كلمة المرور القديمة إذا كان هناك طلب تغيير كلمة المرور
        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $admin->password)) {
                return back()->withErrors([
                    'old_password' => __('validation.custom.old_password')
                ])->withInput();
            }

            $admin->password = Hash::make($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.profile.index')
                         ->with('success', __('admins.updated_message'));
    }
}
