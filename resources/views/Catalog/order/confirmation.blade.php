@extends('layouts.customer')

@section('content')

     <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <ul class="flex space-x-4 text-sm text-gray-500">
                <li><a href="" class="hover:underline">Step 1: Select Size</a></li>
                <li>›</li>
                <li><a href="{{ route('order.cart.view') }}" class=" hover:underline">Step 2: Cart</a></li>
                <li>›</li>
                <li><a href="{{ route('order.details') }}" class="hover:underline">Step 3: Details</a></li>
                <li>›</li>
                <li><a href="" class="text-blue-600 hover:underline">Step 4: Confirmation</a></li>
                <li>›</li>
                <li><a href="" class="hover:underline">Step 5: Payment</a></li>
            </ul>
        </div>
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-8">
        <!-- Header -->
        <div class="flex items-center space-x-3">
            <span class="text-3xl">✅</span>
            <h2 class="text-2xl font-bold text-blue-800">Confirm Your Order</h2>
        </div>
            <p>Pending Order ID: <strong>{{ $order->order_id ?? 'Will be generated upon checkout' }}</strong></p>
            <p class="text-gray-600">Please review your order details before proceeding to payment</p>
           

        <!-- Order Summary -->
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">🧾 Order Summary</h3>
            <div class="space-y-4">
               @foreach ($cartItems as $item)
                    @php
                        $qty = $item['quantity'] ?? 1;
                        $lineTotal = $item['litre']['price'] * $qty;
                    @endphp
                    <div class="py-3 flex items-center gap-4">
                        <!-- Color Preview -->
                        @if (isset($item['color']['color_pallet']))
                            <div class="w-10 h-10 rounded-full border shadow"
                                style="background-image: url('{{ asset('storage/' . $item['color']['color_pallet']) }}'); background-size: cover;"
                                title="{{ $item['color']['color_name'] }}"></div>
                        @endif

                        <div>
                            <p class="text-sm font-medium text-gray-800">
                                🎨 <span class="font-semibold">{{ $item['product']['productName'] }}</span> - {{ $item['color']['color_name'] }} ({{ $item['litre']['litre'] }}L)
                            </p>
                            <p class="text-sm text-gray-500">Color Code: {{ $item['color']['color_code'] }}</p>
                            <p class="text-sm text-gray-700">Quantity: {{ $qty }}</p>
                            <p class="text-sm text-gray-700">Price per unit: RM{{ number_format($item['litre']['price'], 2) }}</p>
                            <p class="text-sm text-gray-800 font-semibold">Subtotal: RM{{ number_format($lineTotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
                <div class="text-right text-lg font-bold text-gray-800 mt-4">
                    💳 Total: RM{{ number_format(collect($cartItems)->sum(fn($item) => $item['litre']['price'] * ($item['quantity'] ?? 1)), 2) }}
                </div>

        </div>

        <!-- Customer Details -->
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-3">👤 Customer Information</h3>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg space-y-1">
                <p><strong>👨‍💼 Name:</strong> {{ $customer['name'] }}</p>
                <p><strong>📞 Phone:</strong> {{ $customer['phone'] }}</p>
                <p><strong>📧 Email:</strong> {{ $customer['email'] }}</p>
                <p><strong>🏠 Address:</strong> {{ $customer['address'] }}</p>
            </div>
        </div>
        <!-- Payment Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg text-sm text-gray-700">
            <p><strong>📌 Payment Instructions:</strong></p>
            <ul class="list-disc ml-6 mt-2">
                <li>Transfer to <strong>Maybank 1234567890</strong></li>
                <li>Account Name: <strong>Fitrafham Paints</strong></li>
                <li>Upload proof of payment after order</li>
                <li>You’ll also receive a PDF receipt by email</li>
            </ul>
        </div>

        <!-- Confirm Button -->
        <form action="{{ route('order.checkout') }}" method="POST" class="text-right">
            @csrf
            <input type="hidden" name="name" value="{{ $customer['name'] }}">
            <input type="hidden" name="phone" value="{{ $customer['phone'] }}">
            <input type="hidden" name="email" value="{{ $customer['email'] }}">
            <input type="hidden" name="address" value="{{ $customer['address'] }}">

            <a href="{{ route('order.details') }}" class="inline-block text-blue-600 hover:underline mr-4">← Back to Details</a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-400 transition">
                Confirm Order
            </button>
        </form>
    </div>
</div>
@endsection