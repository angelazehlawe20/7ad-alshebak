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
        $categories = Category::all();
        return view('admin.menu_items.index', compact('items', 'categories'));
    }

    public function filterByCategory(Request $request)
    {
        $id = $request->input('id');
        $categories = Category::all();
        $items = $id
            ? MenuItem::where('category_id', $id)->with('category')->get()
            : MenuItem::with('category')->get();

        return view('admin.menu_items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menu_items.create', compact('categories'));
    }

    public function createItemInCategory(Request $request)
    {
        $id = $request->input('id');
        $category = Category::findOrFail($id);
        $categories = Category::all(); // لازم لإعادة استخدام نفس الـ Blade
        return view('admin.menu_items.create', compact('category', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu_items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إن وُجدت
            if ($menuItem->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($menuItem->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menuItem->image);
            }

            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
