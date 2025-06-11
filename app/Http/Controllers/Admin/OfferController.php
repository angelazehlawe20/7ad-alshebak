<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;

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
            'valid_until' => 'required|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('offers', 'public');
        }

        Offer::create($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully.');
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
            'valid_until' => 'required|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إن وُجدت
            if ($offer->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($offer->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($offer->image);
            }

            $validated['image'] = $request->file('image')->store('offers', 'public');
        }

        $offer->update($validated);

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully.');
    }

    // حذف عرض معين
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', 'Offer deleted successfully.');
    }
}
