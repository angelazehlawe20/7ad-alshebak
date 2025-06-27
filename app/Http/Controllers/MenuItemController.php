<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::with('menuItems')->get();

        return view('partials.menu', compact('categories'));
    }


}
