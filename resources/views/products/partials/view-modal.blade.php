@props(['product'])

<flux:modal name="view-modal-{{ $product->id }}" class="w-full max-w-3xl h-[600px] overflow-y-auto rounded-2xl shadow-xl bg-white">
    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-gray-900">{{ $product->productName }}</h3>
        </div>

        <hr class="border-gray-200">

        <!-- Product Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 rounded-lg bg-gray-50 border">
                <p class="text-gray-700"><strong>Category:</strong></p>
                <p class="text-gray-600">{{ $product->category }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50 border">
                <p class="text-gray-700"><strong>Size:</strong></p>
                <p class="text-gray-600">{{ $product->sizes }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50 border">
                <p class="text-gray-700"><strong>Min Price:</strong></p>
                <p class="text-green-600 font-semibold">RM {{ number_format($product->min_price, 2) }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50 border">
                <p class="text-gray-700"><strong>Max Price:</strong></p>
                <p class="text-green-600 font-semibold">RM {{ number_format($product->max_price, 2) }}</p>
            </div>
        </div>

        <!-- Description -->
        <div class="p-4 rounded-lg bg-gray-50 border">
            <p class="text-gray-700"><strong>Description:</strong></p>
            <p class="text-gray-600 leading-relaxed">
                {{ $product->description }}
            </p>
        </div>
    </div>
</flux:modal>
