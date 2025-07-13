@php
    $statusStyles = [
        'pending' => 'background-color: #FFF8E1; color: #FF9800;',     // Light yellow bg, orange text
        'paid' => 'background-color: #E8F5E9; color: #4CAF50;',        // Light green bg, green text
        'completed' => 'background-color: #E3F2FD; color: #2196F3;',   // Light blue bg, blue text
        'in-review' => 'background-color: #FFF3E0; color: #FF5722;',   // Light orange bg, dark orange text
        'new' => 'background-color: #F3E5F5; color: #9C27B0;',         // Light purple bg, purple text
    ];
@endphp

<!-- Per-Tab Search and Filter -->
<div class="flex flex-wrap gap-3 items-center mb-4">
    <form id="searchForm-{{ $tab }}" class="flex flex-wrap gap-3 w-full">
        <div class="flex-1 min-w-xs">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search {{ ucfirst($tab) }} orders..."
                class="w-full rounded-md border border-gray-300 text-gray-700 px-3 py-2 focus:ring focus:ring-yellow-300">
        </div>
        <flux:button 
            icon="magnifying-glass" 
            type="submit" 
            variant="primary"
            class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition"
        >
        </flux:button>
    </form>
</div>

<!-- Orders Table -->
<table class="w-full text-sm divide-y divide-gray-200">
    <thead class="bg-gray-50 text-gray-700">
        <tr style="background-color: #e8e9e9;">
            <th class="px-4 py-3 text-left font-semibold">#</th>
            <th class="px-4 py-3 text-left font-semibold">Order ID</th>
            <th class="px-4 py-3 text-left font-semibold">Customer</th>
            <th class="px-4 py-3 text-left font-semibold">Phone No</th>
            <th class="px-4 py-3 text-left font-semibold">Total</th>
            <th class="px-4 py-3 text-left font-semibold">Date</th>
            <th class="px-4 py-3 text-left font-semibold">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-100">
        @forelse ($orders as $index => $order)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-700">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="text-blue-600 hover:underline font-medium">
                        #{{ $order->order_id }}
                    </a>
                </td>
                <td class="px-4 py-3 text-gray-700">{{ $order->customer_name }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $order->customer_phone }}</td>
                <td class="px-4 py-3 font-semibold text-gray-900">RM{{ number_format($order->total_price, 2) }}</td>
                <td class="px-4 py-3 text-gray-700">{{ $order->created_at->format('Y-m-d') }}</td>
                <td class="px-4 py-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                            style="{{ $statusStyles[$order->status] ?? 'background-color:#ECEFF1; color:#607D8B;' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">No orders found in this tab.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
@if ($orders->hasPages())
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endif
