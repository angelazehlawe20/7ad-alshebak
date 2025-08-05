<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    // عرض صفحة about للزوار
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
        $request->validate([
            'main_text_en' => 'nullable|string',
            'main_text_ar' => 'nullable|string',
            'gallery_images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg',
        ]);

        $about = About::first() ?? new About();

        $about->main_text_en = $request->main_text_en;
        $about->main_text_ar = $request->main_text_ar;
        $existingMedia = json_decode($request->input('existing_images'), true) ?? [];

        $oldMedia = json_decode($about->gallery_images ?? '[]', true);
        $removedMedia = array_diff($oldMedia, $existingMedia);
        foreach ($removedMedia as $media) {
            $path = public_path($media);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $folder = in_array($extension, ['mp4', 'webm', 'ogg']) ? 'videos/gallery' : 'images/gallery';
                $filename = uniqid() . '.' . $extension;
                $file->move(public_path($folder), $filename);
                $existingMedia[] = "$folder/$filename";
            }
        }

        $about->gallery_images = json_encode(array_values($existingMedia));
        $about->save();

        return redirect()->back()->with('success', __('about.updated_message'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg',
            'original_image' => 'nullable|string'
        ]);

        $oldImage = $request->original_image;
        $about = About::first();

        if (!$about || !$oldImage) {
            return response()->json(['success' => false, 'message' => __('about.invalid')]);
        }

        $oldPath = public_path($oldImage);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $folder = in_array($extension, ['mp4', 'webm', 'ogg']) ? 'videos/gallery' : 'images/gallery';
        $filename = uniqid() . '.' . $extension;
        $newImagePath = "$folder/$filename";
        $file->move(public_path($folder), $filename);

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
            'main_text_en' => 'required|string',
            'main_text_ar' => 'required|string',

            'gallery_images.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg'
        ]);

        $about = new About();
        $about->main_text_en = $request->main_text_en;
        $about->main_text_ar = $request->main_text_ar;


        $media = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $extension = $file->getClientOriginalExtension();
                $folder = in_array($extension, ['mp4', 'webm', 'ogg']) ? 'videos/gallery' : 'images/gallery';
                $filename = uniqid() . '.' . $extension;
                $file->move(public_path($folder), $filename);
                $media[] = "$folder/$filename";
            }
        }

        $about->gallery_images = json_encode($media);
        $about->save();

        return redirect()->back()->with('success', __('about.created_message'));
    }

    public function deleteMedia(Request $request)
    {
        $path = $request->input('path');

        // تحقق من أن المسار يبدأ بمجلد 'images/' لتفادي حذف ملفات غير مرغوب فيها
        if ($path && str_starts_with($path, 'images/')) {
            $fullPath = public_path($path);

            if (File::exists($fullPath)) {
                File::delete($fullPath);
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false], 400);
    }
}
