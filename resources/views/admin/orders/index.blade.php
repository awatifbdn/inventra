<x-layouts.app :title="__('Orders')">
    <div class="p-6 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-2xl font-bold text-zinc-800 dark:text-white">📦 Orders Management</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.export.csv') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">Export CSV</a>
                <a href="{{ route('admin.orders.export.pdf') }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">Export PDF</a>
            </div>
        </div>

        <!-- Filter/Search Bar -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer/email" class="px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded w-full sm:w-64 bg-white dark:bg-zinc-700">
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded bg-white dark:bg-zinc-700">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-zinc-700 text-white rounded hover:bg-zinc-800">Search</button>
        </form>

        <!-- Orders Table -->
        <div class="overflow-x-auto rounded-xl shadow border border-zinc-200 dark:border-zinc-700">
            <table class="min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Items</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $orders->firstItem() + $index }}</td>
                            <td class="px-4 py-3">{{ $order->customer_name }}</td>
                            <td class="px-4 py-3">{{ $order->customer_email }}</td>
                            <td class="px-4 py-3">{{ $order->customer_phone ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <ul class="pl-4 list-disc space-y-1">
                                    @foreach ($order->items as $item)
                                        <li class="text-xs text-zinc-700 dark:text-zinc-300">
                                            {{ $item['product']['productName'] }} - {{ $item['color']['color_name'] }} ({{ $item['litre']['litre'] }}L) x{{ $item['quantity'] ?? 1 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-3">RM{{ number_format($order->total_price, 2) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="rounded px-2 py-1 bg-white dark:bg-zinc-700 border border-gray-300 text-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>🕓 Pending</option>
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>💰 Paid</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                                <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-6 text-center text-zinc-500 dark:text-zinc-400">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-layouts.app>
