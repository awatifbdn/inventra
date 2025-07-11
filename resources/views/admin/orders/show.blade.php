<x-layouts.app :title="'Order Receipt - ' . $order->order_id">
    <div class="p-0 max-w-3xl mx-auto rounded-xl shadow-lg border border-zinc-200 overflow-hidden">
        <!-- Gradient Header -->
        <div style="
            background: linear-gradient(135deg, #ffffff, #e4e6e6);
            padding: 1.75rem;
            text-align: center;
        ">
            <h1 style="
                font-size: 1.5rem; 
                font-weight: 700; 
                color: #1f2937; 
                margin-bottom: 0.3rem;
            ">
                Order <span style="font-family: monospace; color: #2563eb;">#{{ $order->order_id }}</span>
            </h1>
            <p style="
                font-size: 0.95rem; 
                color: #4b5563;
            ">
                Placed on: <span style="color: #374151;">{{ $order->created_at->format('F d, Y - H:i') }}</span>
            </p>
        </div>

        <!-- Flat Body -->
        <div style="padding: 1.75rem; background: #ffffff;">
            <!-- Customer Info -->
            <div style="margin-bottom: 1.75rem;">
                <h2 style="
                    font-size: 1.25rem; 
                    font-weight: 600; 
                    color: #1f2937; 
                    border-bottom: 1px dashed #e5e7eb; 
                    padding-bottom: 0.5rem;
                ">
                    Customer Details
                </h2>
                <div style="margin-top: 0.75rem; color: #4b5563; line-height: 1.6;">
                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div style="margin-bottom: 1.75rem;">
                <h2 style="
                    font-size: 1.25rem; 
                    font-weight: 600; 
                    color: #1f2937; 
                    border-bottom: 1px dashed #e5e7eb; 
                    padding-bottom: 0.5rem;
                ">
                    Order Items
                </h2>
                <div style="margin-top: 0.75rem;">
                    @foreach ($order->items as $item)
                        <div style="
                            padding: 1rem 0; 
                            display: flex; 
                            justify-content: space-between; 
                            border-bottom: 1px solid #f3f4f6;
                            color: #4b5563;
                        ">
                            <div>
                                <p style="font-weight: 600; color: #111827;">{{ $item['product']['productName'] }} - {{ $item['color']['color_name'] }}</p>
                                <p style="font-size: 0.9rem; color: #6b7280;">
                                    Size: {{ $item['litre']['litre'] }}L | Code: {{ $item['color']['color_code'] }}
                                </p>
                                <p style="font-size: 0.9rem;">Qty: {{ $item['quantity'] ?? 1 }}</p>
                            </div>
                            <div style="text-align: right;">
                                <p style="font-size: 0.9rem;">Unit Price: RM{{ number_format($item['litre']['price'], 2) }}</p>
                                <p style="font-weight: 700; color: #1f2937;">Subtotal: RM{{ number_format(($item['litre']['price'] * $item['quantity']), 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Section -->
            <div style="text-align: right; margin-top: 1.75rem;">
                <p style="
                    font-size: 1.35rem; 
                    font-weight: 700; 
                    color: #111827;
                ">
                    Grand Total: RM{{ number_format($order->total_price, 2) }}
                </p>
                <p style="
                    font-size: 0.95rem; 
                    margin-top: 0.35rem; 
                    color: #6b7280;
                ">
                    Status: 
                    <span style="
                        padding: 0.3rem 0.6rem; 
                        border-radius: 0.375rem;
                        background-color: {{ $order->status === 'completed' ? '#dcfce7' : ($order->status === 'paid' ? '#fef9c3' : '#fee2e2') }};
                        color: {{ $order->status === 'completed' ? '#166534' : ($order->status === 'paid' ? '#92400e' : '#991b1b') }};
                        font-weight: 600;
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>

            <!-- Footer Actions -->
            <div style="margin-top: 2rem; display: flex; justify-content: space-between;">
                <a href="{{ route('admin.orders.index') }}"
                   style="
                       display: inline-flex; 
                       align-items: center; 
                       gap: 0.5rem; 
                       background-color: #6b7280; 
                       color: white; 
                       padding: 0.75rem 1.5rem; 
                       border-radius: 0.5rem; 
                       text-decoration: none;
                       box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                   ">
                    ← Back to Orders
                </a>
                <button onclick="window.print()"
                        style="
                            display: inline-flex; 
                            align-items: center; 
                            gap: 0.5rem; 
                            background-color: #2563eb; 
                            color: white; 
                            padding: 0.75rem 1.5rem; 
                            border-radius: 0.5rem; 
                            border: none; 
                            cursor: pointer;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                        ">
                    🖨 Print Receipt
                </button>
            </div>
        </div>
    </div>
</x-layouts.app>
