<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero_image;
use App\Models\Hero_Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    public function index()
    {
        $heroPage = Hero_Page::with('images')->first();
        return view('partials.hero', compact('heroPage'));
    }

    public function indexForAdmin()
    {
        $heroPage = Hero_Page::with('images')->latest()->first();
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $heroPage = Hero_Page::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/hero'), $imageName);

                Hero_image::create([
                    'hero_page_id' => $heroPage->id,
                    'image_path' => 'images/hero/' . $imageName,
                ]);
            }
        }

        return redirect()->route('admin.hero.indexForAdmin')->with('success', __('hero.created_succes_message'));
    }

    public function edit($id)
    {
        $heroPage = Hero_Page::with('images')->findOrFail($id);
        return view('admin.hero.edit', compact('heroPage'));
    }

    public function update(Request $request)
    {
        $hero = Hero_Page::first();

        $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $heroData = $request->only(['title_en', 'title_ar']);

        if ($hero) {
            $hero->update($heroData);
        } else {
            $hero = Hero_Page::create($heroData);
        }

        if ($request->hasFile('images')) {
            // Create the directory if it doesn't exist
            $imagePath = public_path('images/hero');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            foreach ($request->file('images') as $imageFile) {
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move($imagePath, $imageName);

                $hero->images()->create([
                    'image_path' => 'images/hero/' . $imageName
                ]);
            }
        }

        return redirect()->back()->with('success', __('hero.updated_success_message'));
    }


    public function deleteImage(Request $request)
    {
        $image = Hero_image::findOrFail($request->image_id);

        if (File::exists(public_path($image->image_path))) {
            File::delete(public_path($image->image_path));
        }

        $image->delete();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $heroPage = Hero_Page::with('images')->findOrFail($id);

        foreach ($heroPage->images as $image) {
            if (File::exists(public_path($image->image_path))) {
                File::delete(public_path($image->image_path));
            }
            $image->delete();
        }

        $heroPage->delete();
        return redirect()->route('admin.hero.indexForAdmin')->with('success', __('hero.deleted_success_message'));
    }
}
