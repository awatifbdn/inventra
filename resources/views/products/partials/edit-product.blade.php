  @props(['product'])

  <!-- Edit product for table view -->
                    <flux:modal name="edit-product-{{ $product->id }}" class="rounded-2xl shadow-xl w-full max-w-5xl bg-white">
                        <div class="p-6 space-y-6">
                             <h3 class="text-xl font-semibold text-gray-800 mb-0.5">Edit Product</h3>
                               <span class="text-sm text-gray-500">Update the product details below.</span>

                            <form action="{{ route('products.updateTable', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <br>
                                <flux:input name="productName" value="{{ $product->productName }}" label="Product Name" />
                                <br>
                                <flux:select name="category" label="Category">
                                    <option value="Exterior" {{ $product->category == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                                    <option value="Interior" {{ $product->category == 'Interior' ? 'selected' : '' }}>Interior</option>
                                    <option value="Glomel" {{ $product->category == 'Glomel' ? 'selected' : '' }}>Glomel</option>
                                    <option value="Protective coatings" {{ $product->category == 'Protective coatings' ? 'selected' : '' }}>Protective coatings</option>
                                    <option value="Sports, courts, coatings" {{ $product->category == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                                    <option value="Waterproofing solutions" {{ $product->category == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
                                </flux:select>
                                <br>
                                <flux:input name="sizes" value="{{ $product->sizes }}" label="Size" />
                                <br>
                                <flux:input name="min_price" value="{{ $product->min_price }}" label="Min Price" type="number" step="0.01" />
                                <br>
                                <flux:input name="max_price" value="{{ $product->max_price }}" label="Max Price" type="number" step="0.01" />
                                <br>
                                <flux:textarea name="description" label="Description">{{ $product->description }}</flux:textarea>
                                <br>
                                <flux:input name="image" type="file" label="Product Image" accept="image/*" />
                                <div class="mt-4 flex justify-end">
                                    <flux:button type="submit" variant="primary">Save Changes</flux:button>
                                </div>
                            </form>
                        </div>
                    </flux:modal>
