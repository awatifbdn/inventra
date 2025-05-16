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
                    <flux:input label="Subheading" name="subheading" oninput="updatePreview()" />
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <flux:select label="Category" name="category" onchange="updatePreview()">
                        <option value="">Select a category</option>
                        <option value="Exterior">Exterior</option>
                        <option value="Interior">Interior</option>          
                        <option value="Glomel">Glomel</option>
                        <option value="Protective coatings">Protective coatings</option>
                        <option value="Sports, courts, coatings">Sports, courts, coatings</option>
                        <option value="Waterproofing solutions">Waterproofing solutions</option>
                    </flux:select>

                    <flux:input label="Key Features" name="key_features" oninput="updatePreview()" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <flux:input label="Color" name="color" oninput="updatePreview()" />
                    <flux:input label="Color Code" name="color_code" oninput="updatePreview()" />
                    <flux:input label="Stock Quantity" name="stock_quantity" type="number" min="0" oninput="updatePreview()" />
                    <flux:input label="Litre" name="litre" type="number" step="0.01" min="0" oninput="updatePreview()" />
                </div>

                <flux:input label="Price (RM)" name="price" type="number" step="0.01" min="0" oninput="updatePreview()" />

                <flux:textarea label="Description" name="description" rows="4" oninput="updatePreview()" />

                <!-- Styled File Upload -->
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
                <p><strong>Subheading:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewSubheading">-</span></p>
                <p><strong>Category:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewCategory">-</span></p>
                <p><strong>Key features:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewFinish">-</span></p>
                <p><strong>Color:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewColor">-</span></p>
                <p><strong>Color Code:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewColorCode">-</span></p>
                <p><strong>Stock:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewStock">-</span></p>
                <p><strong>Litre:</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewLitre">-</span></p>
                <p><strong>Price (RM):</strong> <span class="text-blue-800 dark:text-yellow-200" id="previewPrice">-</span></p>
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
            document.getElementById('previewSubheading').innerText = document.querySelector('[name="subheading"]').value || '-';
            document.getElementById('previewCategory').innerText = document.querySelector('[name="category"]').value || '-';
            document.getElementById('previewFinish').innerText = document.querySelector('[name="key_features"]').value || '-';
            document.getElementById('previewColor').innerText = document.querySelector('[name="color"]').value || '-';
            document.getElementById('previewStock').innerText = document.querySelector('[name="stock_quantity"]').value || '-';
            document.getElementById('previewLitre').innerText = document.querySelector('[name="litre"]').value || '-';
            document.getElementById('previewPrice').innerText = document.querySelector('[name="price"]').value || '-';
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
