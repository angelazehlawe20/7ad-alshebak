<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = MenuItem::all();
        return view('admin.menu_items.index', compact('items'));
    }

    // عرض صفحة إنشاء عنصر جديد
    public function create()
    {
        return view('admin.menu_items.create');
    }

    // تخزين عنصر جديد
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        MenuItem::create($request->all());

        return redirect()->route('admin.menu_items.index')->with('success', 'Menu item created successfully.');
    }

    // عرض صفحة تعديل عنصر معين
    public function edit(MenuItem $menuItem)
    {
        return view('admin.menu_items.edit', compact('menuItem'));
    }

    // تحديث عنصر معين
    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $menuItem->update($request->all());

        return redirect()->route('admin.menu_items.index')->with('success', 'Menu item updated successfully.');
    }

    // حذف عنصر معين
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu_items.index')->with('success', 'Menu item deleted successfully.');
    }
}
