<?php

namespace App\Http\Controllers;

use App\Models\PaintCategory;

class PaintCategoryController extends Controller
{
    // Show all categories on homepage
    public function index()
    {
        $categories = PaintCategory::all();
        return view('home', compact('categories'));
    }

    // Show specific category with its paints
    public function show($id)
    {
        $category = PaintCategory::with('paints')->findOrFail($id);
        return view('category.show', compact('category'));
    }
}
