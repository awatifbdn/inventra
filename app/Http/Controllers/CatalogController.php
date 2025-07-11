<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Models\Product;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with('colors');

    // Filter by category
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    // Search by name or description
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('productName', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    $products = $query->get();
    $categories = Product::select('category')->distinct()->pluck('category');

    return view('catalog.index', compact('products', 'categories'));
}

    public function show($id)
    {
        $product = Product::with('colors.litres')->findOrFail($id);
        return view('catalog.show', compact('product'));
    }

}