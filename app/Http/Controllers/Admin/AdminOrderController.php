<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminOrderController extends Controller
{
  public function index(Request $request)
    {
        $query = Order::query();

        // Optional filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Optional search by customer name or email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate with 10 results per page
        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }



    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:new,pending,paid,completed']);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function exportCsv()
    {
        $orders = Order::all();
        $filename = "orders_" . now()->format('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Customer Name', 'Email', 'Total Price', 'Status', 'Created At']);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->customer_name,
                    $order->customer_email,
                    $order->total_price,
                    $order->status,
                    $order->created_at,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

       public function tab($tab, Request $request)
{
    $query = Order::query();

    // 📥 Inbox tab: show only "new" orders
    if ($tab === 'inbox') {
        $query->where('status', 'new');
    } elseif (in_array($tab, ['pending', 'paid', 'completed'])) {
        $query->where('status', $tab);
    }

    // Apply search filter
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('customer_name', 'like', '%' . $request->search . '%')
              ->orWhere('customer_email', 'like', '%' . $request->search . '%');
        });
    }

    $orders = $query->latest()->paginate(10)->withQueryString();

    if ($request->ajax()) {
        $html = view('admin.orders.partials.tab_table', [
            'orders' => $orders,
            'tab' => $tab,
        ])->render();

        return response()->json(['html' => $html]);
    }

    return view('admin.orders.partials.tab_table', [
        'orders' => $orders,
        'tab' => $tab,
    ])->render();
}



   /* public function exportPdf()
    {
        $orders = Order::all();
        $pdf = Pdf::loadView('admin.orders.export_pdf', compact('orders'));
        return $pdf->download('orders.pdf');
    }

    public function generateReceipt($id)
    {
        $order = Order::findOrFail($id);

        $pdf = Pdf::loadView('admin.orders.receipt', compact('order'));
        return $pdf->download('Receipt_' . $order->order_id . '.pdf');
    }
*/
}

