<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->category;

        $offers = Offer::query()
            ->where('active', true)
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->get();

        $categories = Category::all();

        return view('partials.all_offers', compact('offers', 'categories'));
    }
}
