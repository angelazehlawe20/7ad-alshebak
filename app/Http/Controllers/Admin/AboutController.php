<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('partials.about', compact('about'));
    }

    public function edit()
    {
        $about = About::first() ?? new About();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first() ?? new About();

        $about->main_text = $request->main_text;
        $about->why_title = $request->why_title;
        $about->why_points = json_encode(array_filter(explode("\n", $request->why_points)));

        if ($request->hasFile('gallery_images')) {
            $images = [];
            foreach ($request->file('gallery_images') as $file) {
                $images[] = $file->store('gallery', 'public');
            }
            $about->gallery_images = json_encode($images);
        }

        $about->save();

        return redirect()->back()->with('success', 'Section updated successfully');
    }

    public function create()
    {
        return view('admin.about.create');  // صفحة إنشاء الفورم
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
        $about->why_points = json_encode(array_filter(explode("\n", $request->why_points)));

        if ($request->hasFile('gallery_images')) {
            $images = [];
            foreach ($request->file('gallery_images') as $file) {
                $images[] = $file->store('gallery', 'public');
            }
            $about->gallery_images = json_encode($images);
        } else {
            $about->gallery_images = json_encode([]);
        }

        $about->save();

        return redirect()->back()->with('success', 'About section created successfully');
    }
}
