<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\StockHistory;
use Illuminate\Support\Str;


class InventoryController extends Controller
{
    public function index(Request $request)
            {
                $inventory = Inventory::all(); // Fetch only inventory items

                    return view('inventory.index', [
                    'inventory' => $inventory,
                    'from_date' => null,
                    'to_date' => null,
                    'total_stock' => Inventory::sum('pail_quantity'),
                    'low_stock' => Inventory::where('pail_quantity', '<', 10)->count(),
                    'out_of_stock' => Inventory::where('pail_quantity', 0)->count(),
                ]);
            }
    
   
public function search()
{
    $search = request()->input('search');
    $category = request()->input('category');

    $query = Inventory::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('productName', 'like', "%{$search}%")
              ->orWhere('productCode', 'like', "%{$search}%");
        });
    }

    if ($category) {
        $query->where('category', $category);
    }

    $inventory = $query->get();

    // If no exact matches, try fuzzy match on productName
    $suggestions = collect();
    if ($inventory->isEmpty() && $search) {
        $suggestions = Inventory::where('productName', 'like', "%{$search}%")
                                ->orWhere('productCode', 'like', "%{$search}%")
                                ->limit(5)
                                ->get();
    }

    return view('inventory.index', [
        'inventory' => $inventory,
        'suggestions' => $suggestions,
        'from_date' => null,
        'to_date' => null,
        'total_stock' => Inventory::sum('pail_quantity'),
        'low_stock' => Inventory::where('pail_quantity', '<', 10)->count(),
        'out_of_stock' => Inventory::where('pail_quantity', 0)->count(),
    ]);
}


    // Store a new product..
   public function store(Request $request)
            {
                // Validate incoming form data
                $validated = $request->validate([
                    'productCode'     => 'nullable|string|max:255',
                    'productName'     => 'required|string|max:255',
                    'pail_quantity'   => 'required|integer|min:1',
                    'category'        => 'required|string|max:100',
                    'color'           => 'nullable|string|max:100',
                    'litre'           => 'required|numeric|min:0.5',
                    'notes'           => 'nullable|string|max:500',
                ]);

                // Create a new product record
                $stock = Inventory::create([
                
                    'productCode'      => $validated['productCode'], // Generate a random code if not provided
                    'productName'      => $validated['productName'],
                    'pail_quantity'    => $validated['pail_quantity'],
                    'category'    => $validated['category'],
                    'color'       => $validated['color'] ?? null,
                    'litre'       => $validated['litre'],
                    'notes'       => $validated['notes'] ?? null,
                ]);

                // Optional: flash a success message and redirect
                return redirect()->route('inventory.index')->with('success', 'Product added successfully!');
            }
public function edit(Inventory $inventory)
            {
                return view('inventory.edit', compact('inventoriy'));
            }

public function update(Request $request, Inventory $inventory)
            {
                $validated = $request->validate([
                    'productCode'     => 'nullable|string|max:255',
                    'productName'     => 'required|string|max:255',
                    'pail_quantity'   => 'required|integer|min:1',
                    'category'        => 'required|string|max:100',
                    'color'           => 'nullable|string|max:100',
                    'litre'           => 'required|numeric|min:0.5',
                    'notes'           => 'nullable|string|max:500',
                ]);

                $inventory->update($validated);

                return redirect()->route('inventory.index')->with('success', 'Product updated successfully!');
            }

            

// Update stock
public function updateStock(Request $request)
        {
            $request->validate([
                'stock_id' => 'required|exists:inventories,id',
                'quantity' => 'required|integer|min:1',
                'entry_date' => 'required|date',
                'note' => 'nullable|string|max:1000',
            ]);

            // Get the product from inventory
            $inventory = Inventory::findOrFail($request->stock_id);

            // Update the inventory stock
        if ($request->entry_type === 'out') {
                if ($inventory->pail_quantity < $request->quantity) {
                    return back()->withErrors(['quantity' => 'Not enough stock to reduce.']);
                }
                $inventory->pail_quantity -= $request->quantity;
            } else {
                $inventory->pail_quantity += $request->quantity;
            }

            $inventory->save();

            // Record stock entry in history
            StockHistory::create([
                'inventory_id' => $inventory->id,
                'entry_type' => $request->entry_type, 
                'quantity' => $request->quantity,
                'entry_date' => $request->entry_date,
                'note' => $request->note,
            ]);

            return back()->with('success', 'Stock updated and history recorded.');

        }
    
    // Delete product
    public function destroy(Inventory $inventory)
            {
                $inventory->delete();
                return redirect()->back()->with('success', 'Product deleted!');
            }

    public function history(Request $request)
            {
                $query = StockHistory::with('inventory');

                if ($request->filled('from_date')) {
                    $query->whereDate('entry_date', '>=', $request->from_date);
                }

                if ($request->filled('to_date')) {
                    $query->whereDate('entry_date', '<=', $request->to_date);
                }

                $inventory = Inventory::all(); // Fetch only inventory items
                $history = $query->orderBy('entry_date', 'desc')->paginate(5);

                return view('inventory.history', [
                    'inventory'=> $inventory,
                    'history' => $history,
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                ]);
            }
}



