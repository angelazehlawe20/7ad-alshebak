<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero_Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $hero = Hero_Page::first(); // أو الطريقة التي تجلب بها بيانات الـ hero

        // تحقق هل تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            // مسار الصورة القديمة
            $oldImage = public_path($hero->image);

            // حذف الصورة القديمة لو كانت موجودة
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            // رفع الصورة الجديدة
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/hero'), $imageName);

            // تحديث مسار الصورة في قاعدة البيانات
            $hero->image = 'images/hero/' . $imageName;
        }

        // تحديث باقي الحقول (العناوين، النصوص ...)
        $hero->title_en = $request->input('title_en');
        $hero->title_ar = $request->input('title_ar');
        $hero->main_text_en = $request->input('main_text_en');
        $hero->main_text_ar = $request->input('main_text_ar');

        $hero->save();

        return redirect()->back()->with('success', 'Hero updated successfully.');
    }


    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'original_image' => 'required|string',
        ]);

        $originalImage = $request->input('original_image');
        $imageFile = $request->file('image');

        // اسم جديد عشوائي للصورة
        $newImageName = \Illuminate\Support\Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
        $destinationPath = public_path('images/hero');

        // حفظ الصورة الجديدة
        $imageFile->move($destinationPath, $newImageName);

        // حذف الصورة القديمة إن وجدت
        $oldImagePath = $destinationPath . '/' . basename($originalImage);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        return response()->json([
            'success' => true,
            'newImage' => 'images/hero/' . $newImageName,
        ]);
    }

    public function deleteImage(Request $request)
    {
        $image = $request->image;
        
        // Extract filename from path
        $filename = basename($image);
        
        // Construct full path to image in hero folder
        $imagePath = public_path('images/hero/' . $filename);

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

        // Delete image from storage if exists
        if ($heroPage->image) {
            $imagePath = public_path($heroPage->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $heroPage->delete();
        return redirect()->route('admin.hero.indexForAdmin')->with('success', 'Hero page deleted successfully.');
    }
}
