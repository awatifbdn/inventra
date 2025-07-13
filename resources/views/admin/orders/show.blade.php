<x-layouts.app :title="'Order Details - ' . $order->order_id">
    <div class="p-8 max-w-3xl w-full mx-auto rounded-2xl shadow-lg border border-gray-200 bg-white">
       
        <!-- 📦 Order Header -->
        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg px-8 py-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Order <span class="font-mono text-yellow-600">#{{ $order->order_id }}</span>
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">
                        Placed on <span class="font-medium text-gray-800">{{ $order->created_at->format('F d, Y - H:i') }}</span>
                    </p>
                </div>
                <div>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : ($order->status === 'paid' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 📃 Order Body -->
        <div class="space-y-6 px-8 py-6 mb-8">
            <!-- 👤 Customer Info -->
            <div class="mt-10">
                <h2 class="text-lg font-semibold text-gray-800 border-b border-dashed border-gray-300 pb-2 mb-4">
                    Customer Details <flux:button icon="pencil" variant="ghost" size="sm" class="inline-flex" />
                </h2>
                <div class="space-y-3 text-gray-700 text-sm">
                    <p class="flex items-center gap-2">
                        <flux:icon name="user" class="w-4 h-4 text-gray-500" />
                        <span><strong>Name:</strong> {{ $order->customer_name }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <flux:icon name="envelope" class="w-4 h-4 text-gray-500" />
                        <span><strong>Email:</strong> {{ $order->customer_email }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <flux:icon name="phone" class="w-4 h-4 text-gray-500" />
                        <span><strong>Phone:</strong> {{ $order->customer_phone }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <flux:icon name="map-pin" class="w-4 h-4 text-gray-500" />
                        <span><strong>Address:</strong> {{ $order->customer_address }}</span>
                    </p>
                </div>
            </div>

            <!-- 📦 Order Items -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 border-b border-dashed border-gray-300 pb-2 mb-4">
                    Order Items
                </h2>
                <div class="divide-y divide-gray-100">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between py-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium text-gray-800">{{ $item['product']['productName'] }} - {{ $item['color']['color_name'] }}</p>
                                <p class="text-gray-500 text-xs">
                                    Size: {{ $item['litre']['litre'] }}L | Code: {{ $item['color']['color_code'] }}
                                </p>
                                <p class="text-gray-500 text-xs">Qty: {{ $item['quantity'] ?? 1 }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-500 text-xs">Unit: RM{{ number_format($item['litre']['price'], 2) }}</p>
                                <p class="font-semibold text-gray-800">Subtotal: RM{{ number_format(($item['litre']['price'] * $item['quantity']), 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 💰 Grand Total (right aligned) -->
            <div class="flex justify-end mt-6">
                <p class="text-xl font-bold text-gray-900">
                    <strong>Grand Total: RM{{ number_format($order->total_price, 2) }}</strong>
                </p>
                 
            </div>
            <div class="flex justify-end mt-6">
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex gap-2 items-center space-x-3">
                    @csrf
                    @method('PUT')
                    <select name="status"
                        class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring focus:ring-yellow-300">
                        @foreach (['new','pending', 'paid', 'completed'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="inline-flex items-center gap-4 bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition text-sm">
                        Update
                    </button>
                </form>
            </div>
            <!-- 🔄 Status Update -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 border-b border-dashed border-gray-300 pb-2 mb-4">
                   
                </h2>
                
            </div>

            <!-- 🔥 Action Buttons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('admin.orders.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-600 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-700 transition text-sm shadow">
                    ← Back
                </a>
                <div class="flex gap-3">
                    <a href=""
                       class="inline-flex items-center gap-1 bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 transition text-sm shadow">
                        Receipt
                    </a>
                    <button onclick="window.print()"
                            class="inline-flex items-center gap-1 bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition text-sm shadow">
                        Print
                    </button>
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to cancel this order?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition text-sm shadow">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
