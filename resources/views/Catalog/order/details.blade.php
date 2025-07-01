@extends('layouts.customer')

@section('content')
    <div class="max-w-3xl mx-auto" x-data="{ showModal: false, removeIndex: null }">
        <div class="mb-4">
            <ul class="flex space-x-4 text-sm text-gray-500">
                <li>Step 1: Select Size</li>
                <li>›</li>
                <li><a href="{{ route('order.cart.view') }}" class="hover:underline">Step 2: Cart</a></li>
                <li>›</li>
                <li class="font-semibold text-blue-600">Step 3: Details</li>
                <li>›</li>
                <li>Step 4: Confirmation</li>
                <li>›</li>
                <li>Step 5: Payment</li>
            </ul>
        </div>

        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">🛒 Order Preview & Customer Details</h2>

            <!-- Order Summary -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Order Summary</h3>
                @php 
                    $cartItems = session('cart', []);
                    $total = 0;
                @endphp
                @if(count($cartItems) > 0)
                    <div class="divide-y">
                        @foreach($cartItems as $item)
                            @php
                                $qty = $item['quantity'] ?? 1;
                                $lineTotal = $item['litre']['price'] * $qty;
                                $total += $lineTotal;
                            @endphp
                            <div class="py-3">
                                <p class="text-sm font-medium text-gray-800">🎨 <span class="font-semibold">{{ $item['product']['productName'] }}</span> - {{ $item['color']['color_name'] }} ({{ $item['litre']['litre'] }}L)</p>
                                <p class="text-sm text-gray-500">Color Code: {{ $item['color']['color_code'] }}</p>
                                <p class="text-sm text-gray-700">Quantity: {{ $qty }}</p>
                                <p class="text-sm text-gray-700">Price per unit: RM{{ number_format($item['litre']['price'], 2) }}</p>
                                <p class="text-sm text-gray-800 font-semibold">Subtotal: RM{{ number_format($lineTotal, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right mt-4 font-semibold text-gray-800">
                        Total: RM{{ number_format($total, 2) }}
                    </div>
                @else
                    <p class="text-sm text-gray-500">Your cart is empty.</p>
                @endif
            </div>

            <!-- Customer Form -->
            @if(count($cartItems) > 0)
                <form action="{{ route('order.confirmation') }}" method="POST" class="space-y-4">
                    @csrf
                    <h3 class="text-lg font-semibold text-gray-700">Customer Information</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" placeholder="Your full name" required class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" placeholder="you@example.com" required class="w-full border px-3 py-2 rounded">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="address" placeholder="Your full shipping address" required class="w-full border px-3 py-2 rounded"></textarea>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('order.cart.view') }}" class="text-sm text-blue-600 hover:underline">← Back to Cart</a>
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-400 transition">
                            Next
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
