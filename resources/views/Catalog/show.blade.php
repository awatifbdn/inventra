@extends('layouts.customer')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <a href="{{ route('catalog.index') }}" class="text-blue-600 hover:underline mb-4 block">← Back to Catalog</a>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div>
              @php
                $images = json_decode($product->image_url, true);
            @endphp
              @foreach($images as $image)
              <div class="overflow-hidden rounded-sm  border-gray-200 items-center justify-items-center mb-4">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->productName }}" class="h-50 object-cover" style="width: 200px;"/>
                </div>
                @endforeach
        </div>

        <!-- Product Info -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->productName }}</h1>
            <p class="text-gray-500 mt-1">{{ $product->category }}</p>
            <p class="mt-2 text-gray-700">{{ $product->description }}</p>
            <p class="mt-2 text-gray-600">Available in sizes: {{ $product->sizes }}</p>
            <p class="mt-1 text-gray-700">Price Range: RM{{ $product->min_price }} - RM{{ $product->max_price }}</p>
        </div>
    </div>

    <!-- Color Options -->
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Available Colors</h2>

        <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
           @foreach ($product->colors as $color)
                <form action="{{ route('order.color', $color->id) }}" method="GET">
                    <button type="submit" class="w-full text-left">
                        <div class="bg-white border rounded-lg p-4 mb-4 hover:shadow-lg transition">

                            <!-- Color Swatch as Background Image -->
                            @if($color->color_pallet)
                                    <div class="h-10 mt-2 border-gray-300"
                                        style="height: 100px; width: 100%; max-width: 300px; background-image: url('{{ asset('storage/' . $color->color_pallet) }}'); background-size: cover; background-position: center;">
                                    </div>
                            @endif

                            <p class="font-medium text-gray-900">{{ $color->color_name }}</p>
                            <p class="text-sm text-gray-500">{{ $color->color_code }}</p>

                        </div>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</div>
@endsection

<!-- 
                   -->