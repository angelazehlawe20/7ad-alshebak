<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social_link;
use Illuminate\Http\Request;

class social_linksController extends Controller
{
    public function index()
    {
        $social_link = Social_link::latest()->first();

        return view('admin.social_links.index', compact('social_link'));
    }

    public function showOnFrontend()
    {
        $social_link = \App\Models\Social_link::latest()->first();
        return view('partials.footer', compact('social_link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url'
        ]);

        Social_link::create([
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link
        ]);

        return redirect()->back()->with('success', 'Social links created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'facebook_link' => 'required|url',
            'instagram_link' => 'required|url'
        ]);

        $social_links = Social_link::first();
        if (!$social_links) {
            $social_links = new Social_link();
        }

        $social_links->facebook_link = $request->facebook_link;
        $social_links->instagram_link = $request->instagram_link;
        $social_links->save();

        return redirect()->back()->with('success', 'Social links updated successfully');
    }
}
