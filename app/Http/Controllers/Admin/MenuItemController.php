<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::all();
        $categories = Category::all();
        return view('admin.menu_items.index', compact('items', 'categories'));
    }

    // عرض صفحة إنشاء عنصر جديد
    public function create()
    {
        $categories = Category::all();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/menu_item'), $imageName);
            $data['image'] = 'images/menu_item/' . $imageName;
        }

        MenuItem::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    // عرض صفحة تعديل عنصر معين
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu_items.edit', compact('menuItem', 'categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($menuItem->image && File::exists(public_path($menuItem->image))) {
                File::delete(public_path($menuItem->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/menu_item'), $imageName);
            $data['image'] = 'images/menu_item/' . $imageName;
        }

        $menuItem->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    // حذف عنصر معين
    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image && File::exists(public_path($menuItem->image))) {
            File::delete(public_path($menuItem->image));
        }

        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
