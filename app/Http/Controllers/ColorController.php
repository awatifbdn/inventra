<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Color;
use App\Models\ColorLitre;


use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Product $product)
{
    // Assuming relationship: $product->colors()->with('litres')
    $colors = $product->colors()->with('litres')->get();

    return view('colors.index', compact('product', 'colors'));
}

public function store(Request $request, Product $product)
{
    $validated = $request->validate([
        'color_name'   => 'required|string|max:255',
        'color_code'   => 'nullable|string|max:20',
        'color_pallet' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'litres'       => 'required|array',
        'litres.*'     => 'required|numeric|min:0',
        'prices'       => 'required|array',
        'prices.*'     => 'required|numeric|min:0',
    ]);

    // Handle image upload
    $palletPath = null;
    if ($request->hasFile('color_pallet')) {
        $palletPath = $request->file('color_pallet')->store('color_pallets', 'public');
    }

    // Save color
    $color = new Color();
    $color->product_id = $product->id;
    $color->color_name = $validated['color_name'];
    $color->color_code = $validated['color_code'];
    $color->color_pallet = $palletPath;
    $color->save();

    // Save related litres and prices
    foreach ($validated['litres'] as $index => $litre) {
        ColorLitre::create([
            'color_id' => $color->id,
            'litre'    => $litre,
            'price'    => $validated['prices'][$index],
        ]);
    }

    return redirect()->route('colors.index', $product)
                     ->with('success', 'Color and its pricing added successfully!');
}

}
