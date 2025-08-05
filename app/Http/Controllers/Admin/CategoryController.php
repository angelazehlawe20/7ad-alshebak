<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255|unique:categories,name_ar',
            'name_en' => 'required|string|max:255|unique:categories,name_en',
        ]);

        Category::create([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'slug' => \Illuminate\Support\Str::slug($validatedData['name_en']),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', __('category.created_message'));
    }


    public function show(Category $category)
    {
        $category->load('menuItems');
        $categories = Category::all();
        return view('admin.categories.show', compact('category', 'categories'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $category->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ]);

        return redirect()->route('admin.categories.index')->with('success', __('category.updated_message'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', __('category.deleted_message'));
    }
}
