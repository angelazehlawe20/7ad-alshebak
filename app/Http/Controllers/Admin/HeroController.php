<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero_Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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

        $data = $validated;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/hero'), $imageName);
            $data['image'] = 'images/hero/' . $imageName;
        }

        Hero_Page::create($data);

        return redirect()->route('admin.hero.indexForAdmin')->with('success', __('hero.created_succes_message'));
    }

    public function edit($id)
    {
        $heroPage = Hero_Page::findOrFail($id);
        return view('admin.hero.edit', compact('heroPage'));
    }

    public function update(Request $request)
{
    $hero = Hero_Page::first();

    $validated = $request->validate([
        'title_en' => 'required|string|max:255',
        'title_ar' => 'required|string|max:255',
        'main_text_en' => 'required|string',
        'main_text_ar' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $validated;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/hero'), $imageName);
        $data['image'] = 'images/hero/' . $imageName;

        if ($hero && $hero->image && File::exists(public_path($hero->image))) {
            File::delete(public_path($hero->image));
        }
    }

    if ($hero) {
        $hero->update($data);
    } else {
        Hero_Page::create($data);
    }

    return redirect()->back()->with('success', __('hero.updated_success_message'));
}


    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'original_image' => 'required|string',
        ]);

        $originalImage = $request->input('original_image');
        $imageFile = $request->file('image');

        $newImageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
        $destinationPath = public_path('images/hero');

        $imageFile->move($destinationPath, $newImageName);

        $oldImagePath = $destinationPath . '/' . basename($originalImage);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        return response()->json([
            'success' => true,
            'newImage' => 'images/hero/' . $newImageName,
        ]);
    }

    public function deleteImage(Request $request)
    {
        $image = $request->image;
        $imagePath = public_path('images/hero/' . basename($image));

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image not found: ' . $imagePath
        ]);
    }

    public function destroy($id)
    {
        $heroPage = Hero_Page::findOrFail($id);

        if ($heroPage->image && File::exists(public_path($heroPage->image))) {
            File::delete(public_path($heroPage->image));
        }

        $heroPage->delete();
        return redirect()->route('admin.hero.indexForAdmin')->with('success', __('hero.deleted_success_message'));
    }
}
