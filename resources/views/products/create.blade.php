<x-layouts.app :title="__('Add_Product')">
    <div class="flex flex-row gap-4 w-full">
        <!-- Add Form -->
        <div class="flex-1 flex flex-col gap-6 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 shadow-sm">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Add New Product</h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">Fill in the product details below.</p>
            </div>

            <form action="{{ route('products.store') }}"  method="POST" enctype="multipart/form-data" class="space-y-6" id="productForm">
                @csrf
                @method('POST')
                <div class="grid gap-4 md:grid-cols-2">
                    <flux:input label="Product Name" name="productName" required oninput="updatePreview()" />
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:select wire.model="industry" label="Category" placeholder="Category" name="category" onchange="updatePreview()">
                        <flux:select.option value="Exterior">Exterior</flux:select.option>
                        <flux:select.option value="Interior">Interior</flux:select.option>        
                        <flux:select.option value="Glomel">Glomel</flux:select.option>
                        <flux:select.option value="Protective coatings">Protective coatings</flux:select.option>
                        <flux:select.option value="Sports, courts, coatings">Sports, courts, coatings</flux:select.option>
                        <flux:select.option value="Waterproofing solutions">Waterproofing solutions</flux:select.option>
                    </flux:select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <flux:input label="Min Price" name="min_price"  type="number" min="0" step="0.01" oninput="updatePreview()" />
                    <flux:input label="Max Price" name="max_price"  type="number" min="0" step="0.01" oninput="updatePreview()" />
                    <flux:input label="size" name="sizes" type="text" required oninput="updatePreview()" />
                </div>

                <flux:textarea label="Description" name="description" rows="4" oninput="updatePreview()" />

                <!-- Styled File Upload.. -->
                <div class="space-y-2">
                    <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-white">Product Images</label>
                    <input 
                        type="file" 
                        name="image_url[]"  multiple
                        id="image_url" 
                        accept="image/*" 
                        multiple
                        onchange="previewMultipleImages()"
                        class="w-full rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 px-4 py-2 text-sm text-gray-700 dark:text-white shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition"
                    />
                </div>
               <div id="colorFields" class="space-y-4"></div>


                <div class="flex justify-end gap-3 pt-4">
                    <flux:button as="a" href="{{ route('products.index') }}" variant="filled">Cancel</flux:button>
                    <flux:button type="submit" variant="primary" >Save Product</flux:button>
                </div>
            </form>
        </div>

        <!-- Preview -->
        <div class="flex-1 flex flex-col gap-6 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800 shadow-sm">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Live Preview</h2>
                <p class="text-sm text-gray-500 dark:text-gray-300">Your product preview updates live.</p>
            </div>

            <!-- Image Preview -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Image Preview</label>
                <div id="imagePreviewContainer" class="flex flex-wrap gap-2 max-h-40 overflow-y-auto p-2 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-zinc-700"></div>
            </div>

            <!-- Textual Preview -->
            <div class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <p><strong>Name:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewName">-</span></p>
                <p><strong>Category:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewCategory">-</span></p>
                <p><strong>Size:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewSize">-</span></p>
                <p><strong>Minimum Price (RM):</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewMinPrice">-</span></p>
                <p><strong>Maximum Price (RM):</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewMaxPrice">-</span></p>
                <div>
                    <p><strong>Description:</strong></p>
                    <p id="previewDesc" class="text-green-800 dark:text-yellow-200 italic">-</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatePreview() {
            document.getElementById('previewName').innerText = document.querySelector('[name="productName"]').value || '-';
            document.getElementById('previewCategory').innerText = document.querySelector('[name="category"]').value || '-';
            document.getElementById('previewSize').innerText = document.querySelector('[name="sizes"]').value || '-';
            document.getElementById('previewMinPrice').innerText = document.querySelector('[name="min_price"]').value || '-';
            document.getElementById('previewMaxPrice').innerText = document.querySelector('[name="max_price"]').value || '-';
            document.getElementById('previewDesc').innerText = document.querySelector('[name="description"]').value || '-';
        }

        function previewMultipleImages() {
            const imageContainer = document.getElementById('imagePreviewContainer');
            const files = document.getElementById('image_url').files;
            imageContainer.innerHTML = '';

            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-15 h-15 object-cover rounded border border-gray-300 dark:border-gray-600';
                        img.alt = 'Product Image';
                        imageContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</x-layouts.app>
