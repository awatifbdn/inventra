<flux:modal name="edit-stock-{{ $item->id }}" class="rounded-2xl shadow-xl w-full max-w-3xl bg-white">
    <div class="p-6 space-y-6">
        <h3 class="text-2xl font-semibold text-gray-800">Edit Product: <h2 class="text-2xl font-semibold text-blue-600">{{ $item->productName }}</h2></h3>
        <p class="text-sm text-gray-500">Update the details for this product.</p>

        <form action="{{ route('inventory.update', $item->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <flux:input name="productCode" label="Product Code" value="{{ $item->productCode }}" />
            <flux:input name="productName" label="Product Name" value="{{ $item->productName }}" />
            <flux:input name="pail_quantity" label="Pail Quantity" type="number" min="1" value="{{ $item->pail_quantity }}" />

            <flux:select name="category" label="Category">
                <option value="" disabled>Select category</option>
                <option value="Interior" {{ $item->category == 'Interior' ? 'selected' : '' }}>Interior</option>
                <option value="Exterior" {{ $item->category == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                <option value="Glomel" {{ $item->category == 'Glomel' ? 'selected' : '' }}>Glomel</option>
                <option value="Protective coatings" {{ $item->category == 'Protective coatings' ? 'selected' : '' }}>Protective coatings</option>
                <option value="Sports, courts, coatings" {{ $item->category == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                <option value="Waterproofing solutions" {{ $item->category == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
            </flux:select>

            <flux:input name="color" label="Color" value="{{ $item->color }}" />
            <flux:input name="litre" label="Litre Size" type="number" step="0.5" value="{{ $item->litre }}" />
            <flux:input name="notes" label="Notes" value="{{ $item->notes }}" />

            <div class="mt-6 flex justify-end gap-2">
                <flux:button as="button" type="button" variant="subtle" onclick="$modal.close()">Cancel</flux:button>
                <flux:button type="submit" variant="primary">Save Changes</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
