<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // عرض قائمة العروض
    public function index()
    {
        $categories = Category::all();
        $offers = Offer::all();
        return view('admin.offers.index', compact('offers', 'categories'));
    }

    // عرض صفحة إنشاء عرض جديد
    public function create()
    {
        $categories = Category::all();
        return view('admin.offers.create', compact('categories'));
    }

    // تخزين عرض جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'required|boolean',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/offers'), $imageName);
            $validated['image'] = 'images/offers/' . $imageName;
        }

        Offer::create($validated);

        return redirect()->route('admin.offers.index')->with('success', __('offers.created_message'));
    }

    public function filterByCategory(Request $request)
    {
        $categoryId = $request->category;

        $offers = Offer::when($categoryId, function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        $categories = Category::all();

        return view('admin.offers.index', compact('offers', 'categories'));
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->status;

        $offers = Offer::when($status !== null, function ($query) use ($status) {
            $query->where('active', $status);
        })->get();

        $categories = Category::all();

        return view('admin.offers.index', compact('offers', 'categories'));
    }


    // عرض صفحة تعديل عرض معين
    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    // تحديث عرض معين
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'required|boolean',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($offer->image && File::exists(public_path($offer->image))) {
                File::delete(public_path($offer->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/offers'), $imageName);
            $validated['image'] = 'images/offers/' . $imageName;
        }

        $offer->update($validated);

        return redirect()->route('admin.offers.index')->with('success', __('category.updated_message'));
    }

    public function destroy(Offer $offer)
    {
        // حذف الصورة من public عند حذف العرض
        if ($offer->image && File::exists(public_path($offer->image))) {
            File::delete(public_path($offer->image));
        }

        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', __('offers.deleted_message'));
    }
}
