<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    // List all inventory
    public function index()
    {
        $stock = Inventory::all();
        return view('inventory.index', compact('stock'));

    }

    // Store a new product..
    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|string',
            'category' => 'required|string',
            'color' => 'required|string',
            'litre' => 'required|numeric|min:0.5',
            'initial_quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        Inventory::create([
            'productCode' => 'P' . str_pad(Inventory::max('id') + 1, 3, '0', STR_PAD_LEFT),
            'productName' => $request->productName,
            'category' => $request->category,
            'color' => $request->color,
            'litre' => $request->litre,
            'pail_quantity' => $request->initial_quantity,
            'Additional_notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    // Update stock quantity
    public function updateStock(Request $request)
    {
        $request->validate([
            'product' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $stock = Inventory::where('productCode', $request->product)->firstOrFail();
        $stock->increment('pail_quantity', $request->quantity);


        // Optionally: Save stock history log in another table.

        return redirect()->back()->with('success', 'Stock updated successfully!');
    }

    // Edit product details (modal)
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'productName' => 'required|string',
            'category' => 'required|string',
            'color' => 'required|string',
            'litre' => 'required|numeric|min:0.5',
            'pail_quantity' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        $inventory->update([
            'productName' => $request->productName,
            'category' => $request->category,
            'color' => $request->color,
            'litre' => $request->litre,
            'pail_quantity' => $request->pail_quantity,
            'Additional_notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->back()->with('success', 'Product deleted!');
    }
}
