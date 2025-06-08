<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
{
    $items = MenuItem::with('category')->get();
    return view('admin.menu_items.index', compact('items'));
}

    // عرض صفحة إنشاء عنصر جديد
    public function create()
{
    $categories = Category::all(); // اجلب كل التصنيفات

    return view('admin.menu_items.create', compact('categories'));
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

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    // عرض صفحة تعديل عنصر معين
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all(); // Get all categories for the dropdown
        return view('admin.menu_items.edit', compact('menuItem', 'categories'));
    }

    // تحديث عنصر معين
    public function update(Request $request, MenuItem $menuItem)
    {
        // Validate the incoming request data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Update only the validated fields
        $menuItem->update([
            'category_id' => $request->category_id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    // حذف عنصر معين
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
