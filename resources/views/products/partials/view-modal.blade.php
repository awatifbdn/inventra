@props(['product'])

<flux:modal name="view-modal-{{ $product->id }}" class="w-full max-w-3xl h-[600px] overflow-y-auto">
    <div class="space-y-6 p-4">
        <flux:heading size="2xl">{{ $product->productName }}</flux:heading>
        <p class="text-sm text-gray-500 dark:text-gray-400">Detailed product information.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><strong>Category:</strong> {{ $product->category }}</div>
            <div><strong>Size:</strong> {{ $product->sizes }}</div>
            <div><strong>Min Price:</strong> RM {{ number_format($product->min_price, 2) }}</div>
            <div><strong>Max Price:</strong> RM {{ number_format($product->max_price, 2) }}</div>
            <div class="md:col-span-2"><strong>Description:</strong> {{ $product->description }}</div>
        </div>
    </div>
</flux:modal>
