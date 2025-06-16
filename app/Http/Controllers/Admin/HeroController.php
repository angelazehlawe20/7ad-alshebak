<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero_Page;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroPage = Hero_Page::first();
        return view('partials.hero', compact('heroPage'));
    }

    public function indexForAdmin()
    {
        $heroPage = Hero_Page::latest()->first();
        return view('admin.hero.index', compact('heroPage'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'main_text_en' => 'required|string',
            'main_text_ar' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $heroPage = new Hero_Page();
        $heroPage->title_en = $validated['title_en'];
        $heroPage->title_ar = $validated['title_ar'];
        $heroPage->main_text_en = $validated['main_text_en'];
        $heroPage->main_text_ar = $validated['main_text_ar'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/hero'), $imageName);
            $heroPage->image = 'images/hero/' . $imageName;
        }

        $heroPage->save();

        return redirect()->route('admin.hero.indexForAdmin')->with('success', 'Hero page created successfully.');
    }

    public function edit($id)
    {
        $heroPage = Hero_Page::findOrFail($id);
        return view('admin.hero.edit', compact('heroPage'));
    }

    public function update(Request $request)
{
    $validated = $request->validate([
        'title_en' => 'required|string|max:255',
        'title_ar' => 'required|string|max:255',
        'main_text_en' => 'required|string',
        'main_text_ar' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $heroPage = Hero_Page::latest()->first();

    if (!$heroPage) {
        $heroPage = new Hero_Page();
    }

    $heroPage->title_en = $validated['title_en'];
    $heroPage->title_ar = $validated['title_ar'];
    $heroPage->main_text_en = $validated['main_text_en'];
    $heroPage->main_text_ar = $validated['main_text_ar'];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/hero'), $imageName);
        $heroPage->image = 'images/hero/' . $imageName;
    }

    $heroPage->save();

    return redirect()->route('admin.hero.indexForAdmin')->with('success', 'Hero page updated successfully.');
}


    public function destroy($id)
    {
        $heroPage = Hero_Page::findOrFail($id);
        if ($heroPage->image && file_exists(public_path($heroPage->image))) {
            unlink(public_path($heroPage->image));
        }
        $heroPage->delete();
        return redirect()->route('admin.hero.indexForAdmin')->with('success', 'Hero page deleted successfully.');
    }
}
