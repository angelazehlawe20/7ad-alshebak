<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->id;

        if ($categoryId) {
            $items = MenuItem::where('category_id', $categoryId)->get();

            if ($items->isEmpty()) {
                return redirect()->route('admin.menu.index')->with('warning', 'No items found in this category.');
            }
        } else {
            $items = MenuItem::all();
        }

        return view('admin.menu_items.index', compact('items', 'categories'));
    }


    public function filterByCategory(Request $request)
    {
        $categoryId = $request->category_id; // ✅ بدل id

        if ($categoryId) {
            $items = MenuItem::where('category_id', $categoryId)->get();

            if ($items->isEmpty()) {
                return redirect()->route('admin.menu.index')
                    ->with('warning', 'No items found for the selected category.');
            }
        } else {
            $items = MenuItem::all();
        }

        $categories = Category::all();

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
        $categories = Category::all();
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
            // Create menu_items directory if it doesn't exist
            Storage::makeDirectory('public/menu_items');
            $validated['image'] = $request->file('image')->store('menu_items', 'public');
        }

        MenuItem::create($validated);

        // هنا نتحقق من redirect_to
        $redirectTo = $request->input('redirect_to', route('admin.menu.index'));
        return redirect($redirectTo)->with('success', 'Menu item created successfully.');
    }


    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu_items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::findOrFail($id);

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
            // Delete old image if exists
            if ($menuItem->image) {
                Storage::delete('public/' . $menuItem->image);
            }

            // Store new image in menu_items directory
            Storage::makeDirectory('public/menu_items');
            $validated['image'] = $request->file('image')->store('menu_items', 'public');
        }

        $menuItem->update($validated);

        $redirectTo = $request->input('redirect_to', route('admin.menu.index'));
        return redirect($redirectTo)->with('success', 'Menu item updated successfully.');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $menuItem = MenuItem::findOrFail($id);

        // حذف الصورة إن وجدت
        if ($menuItem->image) {
            Storage::delete('public/' . $menuItem->image);
        }

        $menuItem->delete();

        // رجوع إلى صفحة الفئة المحددة إذا كانت موجودة
        if ($request->has('category_id') && $request->category_id != '') {
            return redirect()->route('admin.menu.index', ['id' => $request->category_id])
                ->with('success', 'Menu item deleted successfully.');
        }

        // الرجوع إلى كل العناصر إذا لم يكن هناك فئة محددة
        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
