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
    public function create()
    {
    // Show form to create a new color for a product
        return view('colors.create');
    }
public function store(Request $request, $productId)
{
  
    // Validate the base color info
    $validated = $request->validate([
        'color_name' => 'required|string|max:255',
        'color_code' => 'required|string|max:7',
        'color_pallet' => 'nullable|image',
        'litres' => 'required|array',
        'litres.*' => 'required|numeric|min:0.01',
        'prices' => 'required|array',
        'prices.*' => 'required|numeric|min:0',
    ]);

    // Handle image upload (optional)
    $palletPath = null;
    if ($request->hasFile('color_pallet')) {
        $palletPath = $request->file('color_pallet')->store('color_pallets', 'public');
    }

    // Create Color
    $color = Color::create([
        'color_name' => $validated['color_name'],
        'color_code' => $validated['color_code'],
        'color_pallet' => $palletPath,
        'product_id' => $productId,

    ]);

    
foreach ($validated['litres'] as $index => $litre) {
    $price = $validated['prices'][$index];
    $color->litres()->create([
        'litre' => $litre,
        'price' => $price,
    ]);
}
  

   return redirect()->route('colors.index', ['product' => $color->product_id])
                 ->with('success', 'Color and litres added successfully.');


}




}
