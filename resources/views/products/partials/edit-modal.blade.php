@props(['product'])

<flux:modal name="edit-modal-{{ $product->id }}" class="w-full max-w-5xl">
    <div class="space-y-6 p-4">
        <flux:heading size="lg">Update Product</flux:heading>
        <flux:text class="mt-2">Make changes to the product details below.</flux:text>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <flux:input name="productName" value="{{ $product->productName }}" label="Product Name" />
            <flux:select name="category" label="Category">
                <option value="Exterior" {{ $product->category == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                <option value="Interior" {{ $product->category == 'Interior' ? 'selected' : '' }}>Interior</option>
                <option value="Glomel" {{ $product->category == 'Glomel' ? 'selected' : '' }}>Glomel</option>
                <option value="Protective coatings" {{ $product->category == 'Protective coatings' ? 'selected' : '' }}>Protective coatings</option>
                <option value="Sports, courts, coatings" {{ $product->category == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                <option value="Waterproofing solutions" {{ $product->category == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
            </flux:select>
            <flux:input name="sizes" value="{{ $product->sizes }}" label="Size" />
            <flux:input name="min_price" value="{{ $product->min_price }}" label="Min Price" type="number" step="0.01" />
            <flux:input name="max_price" value="{{ $product->max_price }}" label="Max Price" type="number" step="0.01" />
            <flux:textarea name="description" label="Description">{{ $product->description }}</flux:textarea>
            <div class="mt-4 flex justify-end">
                <flux:button type="submit" variant="primary">Save Changes</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
