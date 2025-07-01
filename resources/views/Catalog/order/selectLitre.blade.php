@extends('layouts.customer')

@section('content')
 <div class="mb-4">
        <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <ul class="flex space-x-4 text-sm text-gray-500">
                <li><a href="" class="text-blue-600 hover:underline">Step 1: Select Size</a></li>
                <li>›</li>
                <li><a href="{{ route('order.cart.view') }}" class=" hover:underline">Step 2: Cart</a></li>
                <li>›</li>
                <li><a href="" class="hover:underline">Step 3: Details</a></li>
                <li>›</li>
                <li><a href="" class="hover:underline">Step 4: Confirmation</a></li>
                <li>›</li>
                <li><a href="" class="hover:underline">Step 4: Payment</a></li>
            </ul>
        </div>
        </div>
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Select Litre Size</h2>

    <div class="mb-6">
        <h3 class="text-xl font-semibold text-blue-700">{{ $color->product->productName }} - {{ $color->color_name }}</h3>
        <p class="text-sm text-gray-500">Color Code: {{ $color->color_code }}</p>

        @if($color->color_pallet)
            <div class="mt-2 h-10 w-64 rounded-full border border-gray-300" style="background-image: url('{{ asset('storage/' . $color->color_pallet) }}'); background-size: cover;"></div>
        @endif
    </div>

   <form action="{{ route('order.addToCart') }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="color_id" value="{{ $color->id }}">

    <!-- Litre Options -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Choose Litre:</label>
        @foreach($color->litres as $litre)
            <div class="flex items-center space-x-3 mb-2">
                <input type="radio" id="litre_{{ $litre->id }}" name="litre_id" value="{{ $litre->id }}" required>
                <label for="litre_{{ $litre->id }}" class="text-gray-800">
                    {{ $litre->litre }} litre - RM{{ number_format($litre->price, 2) }}
                </label>
            </div>
        @endforeach
    </div>

    <!-- Quantity Input -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity:</label>
        <input type="number" name="quantity" min="1" value="1"
               class="w-24 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
               required>
    </div>

    <button type="submit"
            class="mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
        Add to Cart
    </button>
</form>

</div>
@endsection
