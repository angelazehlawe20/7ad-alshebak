<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $offers = Offer::all();
        return view('admin.offers.index', compact('offers'));
    }

    // عرض صفحة إنشاء عرض جديد
    public function create()
    {
        return view('admin.offers.create');
    }

    // تخزين عرض جديد
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'required|boolean',
            'valid_until' => 'required|date|after_or_equal:today',
        ]);

        Offer::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'active' => $request->active,
            'valid_until' => $request->valid_until,
        ]);

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully.');
    }

    // عرض صفحة تعديل عرض معين
    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    // تحديث عرض معين
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'active' => 'required|boolean',
            'valid_until' => 'required|date|after_or_equal:today',
        ]);

        $offer->update($request->all());

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully.');
    }

    // حذف عرض معين
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('admin.offers.index')->with('success', 'Offer deleted successfully.');
    }
}
