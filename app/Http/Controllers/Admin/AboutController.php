<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    // عرض صفحة about للزوار
    public function index()
    {
        $about = About::first();
        return view('partials.about', compact('about'));
    }

    // عرض صفحة about للوحة التحكم
    public function indexForAdmin()
    {
        $about = About::first() ?? new About();
        return view('admin.about.index', compact('about'));
    }

    // تحديث بيانات about
    public function update(Request $request)
    {
        $about = About::first() ?? new About();

        $about->main_text_en = $request->main_text_en;
        $about->main_text_ar = $request->main_text_ar;
        $about->why_title_en = $request->why_title_en;
        $about->why_title_ar = $request->why_title_ar;
        $about->why_points_en = json_encode(array_filter($request->why_points_en));
        $about->why_points_ar = json_encode(array_filter($request->why_points_ar));

        // الصور الحالية بعد الحذف
        $existingImages = json_decode($request->input('existing_images'), true) ?? [];

        // حذف الصور المحذوفة من التخزين
        $oldImages = json_decode($about->gallery_images ?? '[]', true);
        $removedImages = array_diff($oldImages, $existingImages);
        foreach ($removedImages as $image) {
            $path = public_path($image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // إضافة الصور الجديدة
        if ($request->hasFile('new_gallery_images')) {
            foreach ($request->file('new_gallery_images') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/gallery'), $filename);
                $existingImages[] = 'images/gallery/' . $filename;
            }
        }

        $about->gallery_images = json_encode($existingImages);
        $about->save();

        return redirect()->back()->with('success', 'About section updated successfully');
    }

    // تحديث صورة واحدة (عند تعديلها مباشرة في الواجهة)
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'original_image' => 'required|string'
        ]);

        $oldImage = $request->original_image;
        $about = About::first();

        if (!$about || !$oldImage) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        // حذف الصورة القديمة
        $oldPath = public_path($oldImage);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        // رفع الصورة الجديدة
        $file = $request->file('image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $newImagePath = 'images/gallery/' . $filename;
        $file->move(public_path('images/gallery'), $filename);

        // تعديل مسار الصورة في مصفوفة الصور
        $gallery = json_decode($about->gallery_images ?? '[]', true);
        $gallery = array_map(function ($img) use ($oldImage, $newImagePath) {
            return $img === $oldImage ? $newImagePath : $img;
        }, $gallery);

        $about->gallery_images = json_encode($gallery);
        $about->save();

        return response()->json([
            'success' => true,
            'newImage' => $newImagePath,
        ]);
    }


    public function createAbout(Request $request)
    {
        $request->validate([
            'main_text_en' => 'required|string|max:1000',
            'main_text_ar' => 'required|string|max:1000',
            'why_title_en' => 'required|string|max:255',
            'why_title_ar' => 'required|string|max:255',
            'why_points_en' => 'required|array',
            'why_points_ar' => 'required|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $about = new About();
        $about->main_text_en = $request->main_text_en;
        $about->main_text_ar = $request->main_text_ar;
        $about->why_title_en = $request->why_title_en;
        $about->why_title_ar = $request->why_title_ar;
        $about->why_points_en = json_encode(array_filter($request->why_points_en));
        $about->why_points_ar = json_encode(array_filter($request->why_points_ar));

        $images = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/gallery'), $filename);
                $images[] = 'images/gallery/' . $filename;
            }
        }

        $about->gallery_images = json_encode($images);
        $about->save();

        return redirect()->back()->with('success', 'About section created successfully');
    }

    // حذف صورة من المعرض
    public function deleteImage(Request $request)
    {
        $imageToDelete = $request->image;

        $about = About::first();
        if (!$about) {
            return response()->json(['success' => false]);
        }

        $images = json_decode($about->gallery_images ?? '[]', true);

        // حذف من التخزين
        $path = public_path($imageToDelete);
        if (file_exists($path)) {
            unlink($path);
        }

        // حذف من المصفوفة
        $images = array_filter($images, fn($img) => $img !== $imageToDelete);
        $about->gallery_images = json_encode(array_values($images));
        $about->save();

        return response()->json(['success' => true]);
    }
}
