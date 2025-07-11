@php
    $statusFilters = ['' => 'All', 'pending' => 'Pending', 'paid' => 'Paid', 'completed' => 'Completed'];
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'paid' => 'bg-green-100 text-green-800',
        'completed' => 'bg-blue-100 text-blue-800',
    ];
    $icons = [
        'pending' => '⏳',
        'paid' => '💰',
        'completed' => '✅',
    ];
@endphp

<x-layouts.app :title="__('Orders')">
    <div class="p-6 space-y-6">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-2xl font-bold text-zinc-800">📦 Orders Management</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.export.csv') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 transition">Export CSV</a>
                <a href="{{ route('admin.orders.export.pdf') }}" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">Export PDF</a>
=======
=======
>>>>>>> Stashed changes
        <!-- Header with Date Filter and Search -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-zinc-800 dark:text-white">Orders</h2>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Manage your latest customer orders</p>
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            </div>
            <form method="GET" class="flex flex-wrap items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name/email"
                    class="px-2 py-1 border rounded text-sm dark:bg-zinc-700 dark:border-zinc-600" />
                <input type="date" name="from" value="{{ request('from') }}"
                    class="px-2 py-1 border rounded text-sm dark:bg-zinc-700 dark:border-zinc-600" />
                <span class="text-sm text-zinc-500 dark:text-zinc-400">to</span>
                <input type="date" name="to" value="{{ request('to') }}"
                    class="px-2 py-1 border rounded text-sm dark:bg-zinc-700 dark:border-zinc-600" />
                <button type="submit"
                    class="px-3 py-1.5 rounded text-sm bg-indigo-600 text-white hover:bg-indigo-700">Filter</button>
            </form>
        </div>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
        <!-- Filter/Search Bar -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer/email" class="px-3 py-2 border border-gray-300 rounded w-full sm:w-64 bg-white">
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded bg-white">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-zinc-700 text-white rounded hover:bg-zinc-800">Search</button>
        </form>
=======
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.orders.index', ['status' => '']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Total Orders</p>
                <h3 class="text-xl font-bold">{{ $orders->total() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Paid Orders</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'paid')->count() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Completed</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'completed')->count() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Pending</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'pending')->count() }}</h3>
            </a>
        </div>

        <!-- Export Buttons -->
        <div class="flex gap-2 pt-4">
            <a href="{{ route('admin.orders.export.csv') }}" class="btn bg-white border border-zinc-300 hover:bg-zinc-100 text-sm">Export CSV</a>
            <a href="{{ route('admin.orders.export.pdf') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white text-sm">Export PDF</a>
        </div>
>>>>>>> Stashed changes

        <!-- Orders Table -->
        <div class="overflow-x-auto rounded-xl shadow border border-zinc-200">
            <table class="min-w-full text-sm text-left divide-y divide-gray-200">
                <thead class="bg-zinc-100 text-zinc-700">
                    <tr style="background-color: #e8e9e9;">
=======
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.orders.index', ['status' => '']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Total Orders</p>
                <h3 class="text-xl font-bold">{{ $orders->total() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Paid Orders</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'paid')->count() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Completed</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'completed')->count() }}</h3>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="block rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-4 hover:shadow transition">
                <p class="text-sm text-zinc-500">Pending</p>
                <h3 class="text-xl font-bold">{{ $orders->where('status', 'pending')->count() }}</h3>
            </a>
        </div>

        <!-- Export Buttons -->
        <div class="flex gap-2 pt-4">
            <a href="{{ route('admin.orders.export.csv') }}" class="btn bg-white border border-zinc-300 hover:bg-zinc-100 text-sm">Export CSV</a>
            <a href="{{ route('admin.orders.export.pdf') }}" class="btn bg-indigo-600 hover:bg-indigo-700 text-white text-sm">Export PDF</a>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto rounded-xl shadow border border-zinc-200 dark:border-zinc-700">
            <table class="min-w-full text-sm text-left divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs uppercase">
                    <tr>
>>>>>>> Stashed changes
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Order ID</th>
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
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $orders->firstItem() + $index }}</td>
                            <td class="px-4 py-3 font-medium">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">
                                    {{ $order->order_id }}</a></td>
=======
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 font-medium text-zinc-700 dark:text-white">{{ $orders->firstItem() + $index }}</td>
>>>>>>> Stashed changes
=======
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($orders as $index => $order)
                        <tr>
                            <td class="px-4 py-3 font-medium text-zinc-700 dark:text-white">{{ $orders->firstItem() + $index }}</td>
>>>>>>> Stashed changes
                            <td class="px-4 py-3">{{ $order->customer_name }}</td>
                            <td class="px-4 py-3">{{ $order->customer_email }}</td>
                            <td class="px-4 py-3">{{ $order->customer_phone ?? '-' }}</td>
                            <td class="px-4 py-3 text-xs text-zinc-500">
                                <ul class="space-y-1 list-disc pl-4">
                                    @foreach ($order->items as $item)
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                                        <li class="text-xs text-zinc-700">
=======
                                        <li>
>>>>>>> Stashed changes
=======
                                        <li>
>>>>>>> Stashed changes
                                            {{ $item['product']['productName'] }} - {{ $item['color']['color_name'] }} ({{ $item['litre']['litre'] }}L) x{{ $item['quantity'] ?? 1 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-4 py-3 font-semibold">RM{{ number_format($order->total_price, 2) }}</td>
                            <td class="px-4 py-3">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                    @csrf
                                    @method('PUT')
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                                    <select name="status" onchange="this.form.submit()" class="rounded px-2 py-1 bg-white border border-gray-300 text-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>🕓 Pending</option>
=======
                                    <select name="status" onchange="this.form.submit()"
                                        class="px-2 py-1 border border-zinc-300 dark:border-zinc-600 rounded bg-white dark:bg-zinc-700 text-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
>>>>>>> Stashed changes
=======
                                    <select name="status" onchange="this.form.submit()"
                                        class="px-2 py-1 border border-zinc-300 dark:border-zinc-600 rounded bg-white dark:bg-zinc-700 text-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
>>>>>>> Stashed changes
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>💰 Paid</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:underline">View</a>
                                <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-6 text-center text-zinc-500">No orders found.</td>
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
