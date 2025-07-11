<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Responsive design */
        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .search-form {
                width: 100%;
            }
            .add-product-button {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
<x-layouts.app :title="__('Product List')">
    <div class="container mx-auto px-4 py-6">
        
        <!-- Page Heading -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Product List</h2>
        </div>

        <!-- Add Product and Search Bar Container -->
        <div class="mb-4 flex justify-between items-center search-container">
            <button type="button" onclick="window.location.href='{{ route('products.create') }}'" 
                class="add-product-button inline-flex items-center gap-2 bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">
                
                <!-- Plus Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </button>

            <!-- Search and Filter Form -->
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-wrap items-center gap-4 justify-end search-form">
                <div class="relative">
                    <label for="category" class="sr-only">Category</label>
                    <select name="category" id="category" onchange="this.form.submit()" 
                        class="block w-48 rounded-lg border border-gray-300 bg-white text-sm text-gray-700 px-4 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">All Categories</option>
                        <option value="Exterior" {{ request('category') == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                        <option value="Interior" {{ request('category') == 'Interior' ? 'selected' : '' }}>Interior</option>
                        <option value="Glomel" {{ request('category') == 'Glomel' ? 'selected' : '' }}>Glomel</option>
                        <option value="Protective coatings" {{ request('category') == 'Protective coatings' ? 'selected' : '' }}>Protective coatings</option>
                        <option value="Sports, courts, coatings" {{ request('category') == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                        <option value="Waterproofing solutions" {{ request('category') == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
                    </select>
                </div>
                <div class="flex-1 max-w-xs">
                    <flux:input name="search" placeholder="Search products..." value="{{ request('search') }}"/>
                </div>
                <flux:button icon="magnifying-glass" type="submit" variant="primary">
                    <span class="hidden sm:inline">Search</span>
                </flux:button>
            </form>
        </div>

        <!-- View Toggle -->
        <div class="mb-4 flex justify-end left gap-2">
            <button id="toggleView" onclick="toggleView()" 
                class="inline-flex items-center gap-1 px-2 py-1 text-xs bg-gray-200 text-gray-800 rounded shadow hover:bg-gray-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path id="viewIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span id="viewText">Grid View</span>
            </button>
        </div>

        <!-- Table View -->
        <div id="tableView" class="overflow-x-auto bg-white rounded shadow">
            <table class="w-full text-sm text-left table-auto">
                <thead class="bg-zinc-200">
                    <tr class="text-gray-700 uppercase">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Product Name</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Size</th>
                        <th class="px-4 py-2">Min Price</th>
                        <th class="px-4 py-2">Max Price</th>
                        <th class="px-4 py-2">Color</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $product->productName }}</td>
                        <td class="px-4 py-2">{{ $product->category }}</td>
                        <td class="px-4 py-2 truncate">{{ Str::limit($product->description, 30) }}</td>
                        <td class="px-4 py-2">{{ $product->sizes }}</td>
                        <td class="px-4 py-2">RM {{ $product->min_price }}</td>
                        <td class="px-4 py-2">RM {{ $product->max_price }}</td>
                        <td class="text-center">
                            <form action="{{ route('colors.index', $product->id) }}" method="GET">
                                <button
                                    type="submit"
                                    class="text-2xl text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out"
                                    title="View Colors">
                                    🎨
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            <!-- Edit Modal Trigger -->
                            <flux:modal.trigger name="edit-product-{{ $product->id }}">
                                <flux:button icon="pencil" variant="ghost" size="xs" square tooltip="Edit" />
                            </flux:modal.trigger>

                            <!-- Delete Form -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <flux:button icon="trash" type="submit" variant="danger" size="xs" square tooltip="Delete" />
                            </form>

                            <!-- View Modal Trigger -->
                            <flux:modal.trigger name="view-product-{{ $product->id }}">
                                <flux:button icon="eye" variant="subtle" size="xs" square tooltip="View" />
                            </flux:modal.trigger>
                        </td>
                    </tr>

                    <!-- Edit product for table view -->
                    <flux:modal name="edit-product-{{ $product->id }}" class="w-full max-w-5xl">
                        <div class="space-y-6 p-4 text-sm text-gray-700">
                            <flux:heading size="lg"><b>Update Product<b></flux:heading>

                            <flux:text class="">Make changes to the product details below.</flux:text>
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


                    <!-- View product for table view-->
                    <flux:modal name="view-product-{{ $product->id }}" class="w-full max-w-3xl h-[600px] overflow-y-auto">
                        <div class="space-y-6 p-4 text-sm text-gray-700">
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
                    @endforeach
                </tbody>
            </table>
        </div>
                
       <!-- Grid View -->
<div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-sm text-gray-700" style="display: none;">
    @foreach ($products as $product)
    <div class="mt-4 mb-4 border bg-white rounded-lg shadow hover:shadow-lg transition duration-300 flex flex-col">
        <div class="aspect-w-1 aspect-h-1 mt-4 bg-gray-100 rounded-t-lg overflow-hidden">
            @php
                $images = json_decode($product->image_url, true);
            @endphp
            @foreach($images as $image)
            <div class="overflow-hidden rounded-sm border-gray-200 items-center justify-items-center mb-4">
                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->productName }}" class="object-cover" style="height: 150px; width: 100px;" />
            </div>
            @endforeach
        </div>
        <div class="flex-1 p-3 space-y-1">
            <h2 class="text-base font-semibold text-gray-800 truncate">{{ $product->productName }}</h2>
            <p class="text-xs text-gray-500">{{ $product->category }}</p>
            <p class="text-xs text-gray-600 truncate">{{ Str::limit($product->description, 50) }}</p>
            <div class="flex justify-between text-sm font-medium text-green-600">
                <span>RM {{ number_format($product->min_price, 2) }} - RM {{ number_format($product->max_price, 2) }}</span>
                
            </div>
        </div>
        <div class="border-t border-gray-200 p-3 flex gap-2">
            <flux:modal.trigger name="edit-modal-{{ $product->id }}">
                <flux:button icon="pencil" variant="subtle" size="sm" tooltip="Edit" />
            </flux:modal.trigger>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                @csrf
                @method('DELETE')
                <flux:button icon="trash" type="submit" variant="subtle" size="sm" tooltip="Delete" />
            </form>
            <flux:modal.trigger name="view-modal-{{ $product->id }}">
                <flux:button icon="eye" variant="subtle" size="sm" tooltip="View" />
            </flux:modal.trigger>
        </div>
    </div>
    @endforeach
</div>


          <!-- Modals -->
            @foreach ($products as $product)
                @include('products.partials.edit-modal', ['product' => $product])
                @include('products.partials.view-modal', ['product' => $product])
            @endforeach
        <!-- Pagination -->
        <div class="mt-4">{{ $products->links() }}</div>
    </div>

    <script>
        function toggleView() {
            const tableView = document.getElementById('tableView');
            const gridView = document.getElementById('gridView');
            const viewText = document.getElementById('viewText');
            if (tableView.style.display === 'none') {
                tableView.style.display = '';
                gridView.style.display = 'none';
                viewText.textContent = 'Grid View';
            } else {
                tableView.style.display = 'none';
                gridView.style.display = '';
                viewText.textContent = 'Table View';
            }
        }
    </script>
</x-layouts.app>

</body>
</html>
