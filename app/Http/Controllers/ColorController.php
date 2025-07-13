<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Color;
use App\Models\ColorLitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    public function index(Product $product)
    {
        // Load all colors with litres for a specific product
        $colors = $product->colors()->with('litres')->get();

        return view('colors.index', compact('product', 'colors'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'color_name' => 'required|string|max:255',
            'color_code' => 'required|string|max:7',
            'color_pallet' => 'nullable|image',
            'litres' => 'required|array',
            'litres.*' => 'required|numeric|min:0.01',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
        ]);

        $palletPath = null;
        if ($request->hasFile('color_pallet')) {
            $palletPath = $request->file('color_pallet')->store('color_pallets', 'public');
        }

        $color = $product->colors()->create([
            'color_name' => $validated['color_name'],
            'color_code' => $validated['color_code'],
            'color_pallet' => $palletPath,
        ]);

        foreach ($validated['litres'] as $index => $litre) {
            $color->litres()->create([
                'litre' => $litre,
                'price' => $validated['prices'][$index],
            ]);
        }

        return redirect()->route('colors.index', $product->id)
            ->with('success', 'Color and litres added successfully.');
    }

    public function edit(Product $product, Color $color)
    {
        $color->load('litres');
        return view('colors.edit', compact('product', 'color'));
    }

   public function update(Request $request, Product $product, Color $color)
{
    $validated = $request->validate([
        'color_name' => 'required|string|max:255',
        'color_code' => 'required|string|max:7',
        'color_pallet' => 'nullable|image',
        'sizes_json' => 'required|string', // JSON encoded sizes
    ]);

    // Update basic fields
    $color->color_name = $validated['color_name'];
    $color->color_code = $validated['color_code'];

    // Handle new image upload
    if ($request->hasFile('color_pallet')) {
        if ($color->color_pallet && Storage::disk('public')->exists($color->color_pallet)) {
            Storage::disk('public')->delete($color->color_pallet);
        }
        $color->color_pallet = $request->file('color_pallet')->store('color_pallets', 'public');
    }
    $color->save();

    // Update litres
    $sizes = json_decode($validated['sizes_json'], true);
    $color->litres()->delete();
    foreach ($sizes as $size) {
        $color->litres()->create([
            'litre' => $size['litre'],
            'price' => $size['price'],
        ]);
    }

    return redirect()->route('colors.index', ['product' => $product->id])
        ->with('success', 'Color updated successfully.');
}


    public function destroy(Product $product, Color $color)
    {
        if ($color->color_pallet && Storage::disk('public')->exists($color->color_pallet)) {
            Storage::disk('public')->delete($color->color_pallet);
        }

        $color->litres()->delete();
        $color->delete();

        return redirect()->route('colors.index', $product->id)
            ->with('success', 'Color deleted successfully.');
    }

    public function bulkDelete(Request $request, Product $product)
    {
        $ids = explode(',', $request->input('ids'));

        $colors = $product->colors()->whereIn('id', $ids)->get();

        foreach ($colors as $color) {
            if ($color->color_pallet && Storage::disk('public')->exists($color->color_pallet)) {
                Storage::disk('public')->delete($color->color_pallet);
            }
            $color->litres()->delete();
            $color->delete();
        }

        return back()->with('success', 'Selected colors deleted.');
    }

    public function adjustPrice(Request $request, Product $product)
    {
        $ids = explode(',', $request->input('ids'));
        $price = $request->input('price');

        foreach (ColorLitre::whereIn('color_id', $ids)->get() as $litre) {
            $litre->price = $price;
            $litre->save();
        }

        return back()->with('success', 'Prices adjusted successfully.');
    }
}
