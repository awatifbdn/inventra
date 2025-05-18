<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Optional: Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Optional: Search by product name or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('productName', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'productName'    => 'required|string|max:255',
            'category'       => 'required|string|max:255',
            'sizes'           => 'required|string|max:255',
            'min_price'      => 'required|numeric|min:0',
            'max_price'      => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'image_url.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store multiple images if uploaded..
        $imagePaths = [];
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        $validated['image_url'] = json_encode($imagePaths);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'productName'    => 'required|string|max:255',
            'category'       => 'required|string|max:255',
            'sizes'           => 'required|string|max:255',
            'min_price'      => 'required|numeric|min:0',
            'max_price'      => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'image_url.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Optional: replace images if new ones are uploaded
        if ($request->hasFile('image_url')) {
            $imagePaths = [];
            foreach ($request->file('image_url') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
            $validated['image_url'] = json_encode($imagePaths);
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
