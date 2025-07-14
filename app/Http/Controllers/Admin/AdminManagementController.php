<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        $admins = Admin::where('id', '!=', auth()->guard('admin')->id())->get();
        return view('admin.admin_management.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return view('admin.admin_management.create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_owner' => false, // Regular admin by default
            'activation_code' => \Illuminate\Support\Str::random(8),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', __('admins.added_admin_message'));
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit($id)
    {
        $useradmin = Admin::findOrFail($id);
        return view('admin.admin_management.edit', compact('useradmin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($admin->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.admins.index')
            ->with('success', __('admins.admin_updated_message'));
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(Admin $admin)
    {

        // Prevent deleting self
        if ($admin->id === auth()->guard('admin')->id()) {
            return redirect()->route('admin.admins.index')
                ->with('error', __('admins.error_deleted_message'));
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', __('admins.Admin_deleted_message'));
    }
}
