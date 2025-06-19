@extends('layouts.customer')
@section('content')
    <div class="max-w-3xl mx-auto" x-data="{ showModal: false, removeIndex: null }">
        <div class="mb-4">
            <ul class="flex space-x-4 text-sm text-gray-500">
                <li>Step 1: Select Size</li>
                <li>›</li>
                <li class="font-semibold text-blue-600">Step 2: Cart</li>
                <li>›</li>
                <li>Step 3: Details</li>
                <li>›</li>
                <li><a>Step 4: Confirmation</a></li>
                <li>›</li>
                <li>Step 5: Payment</li>
            </ul>
        </div>

        <h2 class="text-3xl font-bold text-gray-800 mb-4">🛒 Your Cart</h2>

        @if(count($cartItems) > 0)
            <ul class="space-y-4">
                @php $total = 0; @endphp
                    @foreach ($cartItems as $index => $item)
                        @php 
                            $qty = $item['quantity'] ?? 1; 
                            $lineTotal = $item['litre']['price'] * $qty;
                            $total += $lineTotal;
                        @endphp
                        <li class="p-4 bg-white shadow rounded relative flex items-center gap-4">
                            <!-- Color Swatch -->
                            @if(isset($item['color']['color_pallet']))
                                <div class="w-24 h-24 border shadow" 
                                    style="background-image: url('{{ asset('storage/' . $item['color']['color_pallet']) }}'); background-size: cover;" 
                                    title="{{ $item['color']['color_name'] }}">
                                </div>
                            @endif

                            <!-- Product Info -->
                            <div class="flex-1">
                                <p><strong>{{ $item['product']['productName'] }}</strong></p>
                                <p><strong>Color:</strong> {{ $item['color']['color_name'] }}</p>
                                <p><strong>Size:</strong> {{ $item['litre']['litre'] }}L</p>
                                <p><strong>Price:</strong> RM{{ number_format($item['litre']['price'], 2) }}</p>
                                <p><strong>Quantity:</strong> {{ $qty }}</p>
                                <p><strong>Subtotal:</strong> RM{{ number_format($lineTotal, 2) }}</p>
                            </div>

                            <!-- Remove Button -->
                            <button type="button" @click="showModal = true; removeIndex = {{ $index }}" class="absolute top-2 right-2 text-red-500 hover:underline text-sm">
                                Remove
                            </button>
                        </li>
                    @endforeach

            </ul>

           <div class="mt-6 text-right">
                <p class="text-lg font-semibold text-gray-700 mb-4">Total: RM{{ number_format($total, 2) }}</p>
                <div class="flex justify-between">
                    <a href="/catalog" class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded">
                        ← Continue Shopping
                    </a>
                    <a href="{{ route('order.details') }}"  class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-400">
                        Next
                    </a>
                </div>
            </div>


            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow p-6 max-w-md w-full">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Remove Item</h3>
                    <p class="text-gray-600 mb-6">Are you sure you want to remove this item from your cart?</p>
                    <div class="flex justify-end space-x-3">
                        <button @click="showModal = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                        <form :action="`/order/cart/remove/${removeIndex}`" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <p class="text-gray-600">Your cart is currently empty.</p>
        @endif
    </div>
    @endsection


