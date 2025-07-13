<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        // ✅ Summary Cards
        $total_products = Product::count();
        $total_inventory = Inventory::sum('pail_quantity'); // assuming 'pail_quantity' as stock
        $total_orders = Order::count();
        $pending_orders = Order::where('status', 'pending')->count();

        // 📊 Sales Trend (Orders per day for last 7 days)
        $sales = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $sales_dates = $sales->pluck('date')->map(fn($date) => date('M d', strtotime($date)));
        $sales_counts = $sales->pluck('count');

        // 📦 Inventory Breakdown (by category)
        $inventory = Product::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        $inventory_categories = $inventory->pluck('category');
        $inventory_counts = $inventory->pluck('count');

        // 🛒 Recent Orders (latest 5)
        $recent_orders = Order::latest()->take(5)->get();

        // 📦 Recent Products (latest 5)
        $recent_products = Product::latest()->take(5)->get();

        // Status badge styles for Blade
        $statusStyles = [
            'pending'   => 'background-color: #FFF8E1; color: #FF9800;',
            'paid'      => 'background-color: #E8F5E9; color: #4CAF50;',
            'completed' => 'background-color: #E3F2FD; color: #2196F3;',
            'in-review' => 'background-color: #FFF3E0; color: #FF5722;',
            'new'       => 'background-color: #F3E5F5; color: #9C27B0;',
        ];

        return view('admin.dashboard', compact(
            'total_products',
            'total_inventory',
            'total_orders',
            'pending_orders',
            'sales_dates',
            'sales_counts',
            'inventory_categories',
            'inventory_counts',
            'recent_orders',
            'recent_products',
            'statusStyles'
        ));
    }
}
