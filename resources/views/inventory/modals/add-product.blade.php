<flux:modal name="add-product" class="rounded-2xl shadow-xl w-full max-w-5xl bg-white">
    <div class="p-6 space-y-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-0.5">Add New Product</h3>
        <span class="text-sm text-gray-500">Fill in the product details below.</span>
        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
            @csrf
            @method('POST')
            <br>
            <flux:input name="productCode" label="Product Code" placeholder="e.g., 12345" />
            <br>
            <flux:input name="productName" label="Product Name" placeholder="e.g., Super Gloss Paint" />
            <br>
            <flux:input name="pail_quantity" label="Pail Quantity" type="number" min="1" placeholder="e.g., 50" />
            <br>
            <flux:select name="category" label="Category">
                <option value="" disabled selected>Select category</option>
                <option value="Interior">Interior</option>
                <option value="Exterior">Exterior</option>
                <option value="Glomel">Glomel</option>
                <option value="Protective coatings">Protective coatings</option>
                <option value="Sports, courts, coatings">Sports, courts, coatings</option>
                <option value="Waterproofing solutions">Waterproofing solutions</option>
            </flux:select>
            <br>
            <flux:input name="color" label="Color" placeholder="e.g., Blue" />
            <br>
            <flux:input name="litre" label="Litre Size" type="number" step="0.5" placeholder="e.g., 5" />
            <br>
            <flux:input name="notes" label="Notes" placeholder="Optional notes..." />

            <div class="mt-6 flex justify-end gap-2">
                <flux:button as="button" type="button" variant="subtle" onclick="$modal.close()">Cancel</flux:button>
                <flux:button type="submit" variant="primary">Add Product</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
