<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\StockHistory;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $inventory = Inventory::paginate(15);

        $totals = $this->getInventoryTotals();

        return view('inventory.index', [
            'inventory'    => $inventory,
            'total_stock'  => $totals->total_stock,
            'low_stock'    => $totals->low_stock,
            'out_of_stock' => $totals->out_of_stock,
        ]);
    }

    public function search()
    {
        $search   = request()->input('search');
        $category = request()->input('category');

        $query = $this->buildSearchQuery($search);

        if ($category) {
            $query->where('category', $category);
        }

        $inventory = $query->paginate(15);
        $totals = $this->getInventoryTotals();

        return view('inventory.index', [
            'inventory'    => $inventory,
            'total_stock'  => $totals->total_stock,
            'low_stock'    => $totals->low_stock,
            'out_of_stock' => $totals->out_of_stock,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        Inventory::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Product added successfully!');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $this->validateProduct($request);
        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Product updated successfully!');
    }

    public function updateStock(Request $request)
    {
        $request->validate([
            'product_id'  => 'required|exists:inventories,id',
            'entry_type'  => 'required|in:in,out',
            'quantity'    => 'required|integer|min:1',
            'entry_date'  => 'required|date',
            'note'        => 'nullable|string|max:1000',
        ]);

        $inventory = Inventory::findOrFail($request->product_id);

        if ($request->entry_type === 'out') {
            if ($inventory->pail_quantity < $request->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock to reduce.']);
            }
            $inventory->pail_quantity -= $request->quantity;
        } else {
            $inventory->pail_quantity += $request->quantity;
        }

        $inventory->save();

        StockHistory::create([
            'inventory_id' => $inventory->id,
            'entry_type'   => $request->entry_type,
            'quantity'     => $request->quantity,
            'entry_date'   => $request->entry_date,
            'note'         => $request->note,
        ]);

        return back()->with('success', 'Stock updated and history recorded.');
    }

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

        $history = $query->orderBy('entry_date', 'desc')->paginate(5);
        $products = Inventory::select('id', 'productName')->get();

        return view('inventory.history', [
            'history'    => $history,
            'products'   => $products,
            'from_date'  => $request->from_date,
            'to_date'    => $request->to_date,
        ]);
    }

    public function liveSearch(Request $request)
    {
        $query = $this->buildSearchQuery($request->input('q'));

        $results = $query->limit(10)->get(['id', 'productName', 'productCode']);

        return response()->json($results);
    }

    private function buildSearchQuery($search)
    {
        return Inventory::when($search, function ($q) use ($search) {
            $q->where('productName', 'like', "%{$search}%")
              ->orWhere('productCode', 'like', "%{$search}%");
        });
    }

    private function validateProduct(Request $request)
    {
        return $request->validate([
            'productCode'   => 'nullable|string|max:255',
            'productName'   => 'required|string|max:255',
            'pail_quantity' => 'required|integer|min:1',
            'category'      => 'required|string|max:100',
            'color'         => 'nullable|string|max:100',
            'litre'         => 'required|numeric|min:0.5',
            'notes'         => 'nullable|string|max:500',
        ]);
    }

    private function getInventoryTotals()
    {
        return Inventory::selectRaw('
            SUM(pail_quantity) as total_stock,
            SUM(CASE WHEN pail_quantity < 10 THEN 1 ELSE 0 END) as low_stock,
            SUM(CASE WHEN pail_quantity = 0 THEN 1 ELSE 0 END) as out_of_stock
        ')->first();
    }
}
