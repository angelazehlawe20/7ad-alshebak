<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('partials.about', compact('about'));
    }

    public function indexForAdmin()
    {
        $about = About::first() ?? new About();
        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first() ?? new About();

        $about->main_text = $request->main_text;
        $about->why_title = $request->why_title;
        $about->why_points = json_encode(array_filter($request->why_points));

        // الصور المتبقية بعد الحذف
        $existingImages = json_decode($request->input('existing_images'), true) ?? [];

        // Delete removed images from storage
        $oldImages = json_decode($about->gallery_images ?? '[]', true);
        $removedImages = array_diff($oldImages, $existingImages);
        foreach ($removedImages as $image) {
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
        }

        // الصور الجديدة المرفوعة
        if ($request->hasFile('new_gallery_images')) {
            foreach ($request->file('new_gallery_images') as $file) {
                $path = $file->store('gallery', 'public');
                $existingImages[] = $path; // نضيفها للمصفوفة النهائية
            }
        }

        $about->gallery_images = json_encode($existingImages);
        $about->save();

        return redirect()->back()->with('success', 'About section updated successfully');
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function createAbout(Request $request)
    {
        // Validate request data
        $request->validate([
            'main_text' => 'required|string|max:1000',
            'why_title' => 'required|string|max:255',
            'why_points' => 'required|string',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $about = new About();
        $about->main_text = $request->main_text;
        $about->why_title = $request->why_title;
        $about->why_points = json_encode(array_filter($request->why_points));

        if ($request->hasFile('gallery_images')) {
            $images = [];
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('gallery', 'public');
                $images[] = $path;
            }
            $about->gallery_images = json_encode($images);
        } else {
            $about->gallery_images = json_encode([]);
        }

        $about->save();

        return redirect()->back()->with('success', 'About section created successfully');
    }

    public function deleteImage(Request $request)
{
    $imageToDelete = $request->image;

    $about = About::first();
    if (!$about) {
        return response()->json(['success' => false]);
    }

    $images = json_decode($about->gallery_images ?? '[]', true);

    // احذف من التخزين إذا موجود
    if (Storage::disk('public')->exists($imageToDelete)) {
        Storage::disk('public')->delete($imageToDelete);
    }

    // احذف من المصفوفة
    $images = array_filter($images, fn ($img) => $img !== $imageToDelete);

    // حدّث القيمة في قاعدة البيانات
    $about->gallery_images = json_encode(array_values($images));
    $about->save();

    return response()->json(['success' => true]);
}
}
