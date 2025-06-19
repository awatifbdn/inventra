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
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Product List</h2>
        </div>

        <!-- Add Product and Search Bar Container -->
        <div class="mb-4 flex justify-between items-center search-container">
            <button type="button" onclick="window.location.href='{{ route('products.create') }}'" 
                class="add-product-button inline-flex items-center gap-2 bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                
                <!-- Plus Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="6" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </button>


       <!-- Search and Filter Form -->
                <form action="{{ route('products.index') }}" method="GET" class="mb-6 flex flex-wrap items-center gap-4 justify-end search-form">

                    <!-- Category Dropdown (still native) -->
                    <div class="relative">
                        <label for="category" class="sr-only">Category</label>
                        <select name="category" id="category" class="block w-48 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm text-gray-700 dark:text-white px-4 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            <option value="Exterior" {{ request('category') == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                            <option value="Interior" {{ request('category') == 'Interior' ? 'selected' : '' }}>Interior</option>
                            <option value="Glomel" {{ request('category') == 'Glomel' ? 'selected' : '' }}>Glomel </option>
                            <option value="Protective coatings" {{ request('category') == 'Protective coatings' ? 'selected' : '' }}>Protective coatings </option>
                            <option value="Sports, courts, coatings" {{ request('category') == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, court, coatings </option>
                            <option value="Waterproofing solutions" {{ request('category') == 'Waterproofing solutions' ? 'selected' : '' }} >Waterproofing solutions </option>
                        </select>
                    </div>

                    <!-- Search Input (Flux) -->
                    <div class="flex-1 max-w-xs">
                        <flux:input name="search" placeholder="Search products..." value="{{ request('search') }}"/>
                    </div>

                    <!-- Submit Button (Flux) -->
                    <div>
                        <flux:button icon="magnifying-glass" type="submit" variant="primary">
                            <span class="hidden sm:inline">Search</span>
                        </flux:button>
                    </div>

                </form>
        </div>
        
       <!-- Product Table -->
            <div class="overflow-x-auto max-w-max bg-white dark:bg-zinc-800 rounded shadow">
                <table class="w-full text-sm text-left table-auto">
                    <thead class="bg-zinc-200 dark:bg-zinc-700">
                        <tr class="text-gray-700 dark:text-white uppercase">
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Size</th>
                            <th class="px-6 py-3">Min Price (RM)</th>
                            <th class="px-6 py-3">Max Price (RM)</th>
                            <th class="px-6 py-3">Image</th>
                            <th class="px-6 py-3">Color</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                @foreach ($products as $index => $product)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $product->productName }}</td>
                    <td class="px-6 py-4">{{ $product->category }}</td>
                    <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($product->description, 15) }}</td>
                    <td class="px-6 py-4">{{ $product->sizes }}</td>
                    <td class="px-6 py-4">{{ $product->min_price }}</td>
                    <td class="px-6 py-4">{{ $product->max_price }}</td>
                    <td class="px-6 py-4">
                     @php
                        $images = json_decode($product->image_url, true);
                    @endphp

                    @if (is_array($images) && count($images) > 0)
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($images as $image)
                                @php
                                    $name = basename($image);
                                    $short = strlen($name) > 15
                                        ? substr($name, 0, 3) . '..' . substr($name, -6)
                                        : $name;
                                @endphp
                                <li title="{{ $name }}" class="truncate max-w-[150px] text-sm text-gray-800 dark:text-gray-200">
                                    {{ $short }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-gray-500">No image</span>
                    @endif

                    </td>
                 <td class="text-center">
                    <form action="{{ route('colors.index', $product->id) }}" method="GET">
                        <button
                            type="submit"
                            class="text-2xl text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out"
                            title="View Colors"
                        >
                            🎨
                        </button>
                    </form>
                </td>


                    <td class="px-6 py-4 flex gap-2">
                          
                        <!-- Edit Modal Trigger -->
                            <flux:modal.trigger name="edit-product-{{ $product->id }}">
                                <flux:button icon="pencil" variant="primary" size="xs" square tooltip="Edit" />
                            </flux:modal.trigger>

                        <!-- Edit Modal.. -->
                            <flux:modal name="edit-product-{{ $product->id }}" class="w-full max-w-5xl">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Update Product</flux:heading>
                                        <flux:text class="mt-2">Make changes to the product details below.</flux:text>
                                    </div>
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- All input fields here -->
                                        <flux:input name="productName" value="{{ $product->productName }}" label="Product Name" />
                                        <flux:select name="category" label="Category">
                                            <option value="Exterior" {{ $product->category == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                                            <option value="Interior" {{ $product->category == 'Interior' ? 'selected' : '' }}>Interior</option>
                                            <option value="Glomel" {{ $product->category == 'Glomel' ? 'selected' : '' }}>Glomel</option>
                                            <option value="Exterior & Interior" {{ $product->category == 'Exterior & Interior' ? 'selected' : '' }}>Exterior & Interior</option>
                                            <option value="Sports, courts, coatings" {{ $product->category == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                                            <option value="Waterproofing solutions" {{ $product->category == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
                                        </flux:select>
                                        <flux:input name="sizes" value="{{ $product->sizes }}" label="size"/>
                                        <flux:input name="min_price" value="{{ $product->min_price }}" label="Price (RM)" type="number" step="0.01" />
                                        <flux:input name="max_price" value="{{ $product->max_price }}" label="Price (RM)" type="number" step="0.01" />
                                        <flux:textarea name="description" label="Description" rows="4">{{ $product->description }}</flux:textarea>
                                        

                                        <div>
                                            <label for="editImages" class="block mb-1 font-medium text-sm text-gray-700 dark:text-white">Product Image</label>
                                            <input type="file" name="image_url[]" id="editImages" accept="image/*" multiple
                                                class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold
                                                file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100
                                                dark:file:bg-zinc-700 dark:file:text-white dark:hover:file:bg-zinc-600" />
                                        </div>

                                        <div class="flex">
                                            <flux:spacer />
                                            <flux:button type="submit" variant="primary">Save Changes</flux:button>
                                        </div>
                                    </form>
                                </div>
                            </flux:modal>

                            <!-- Delete Form -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <flux:button icon="trash" type="submit" variant="danger" size="xs" square tooltip="Delete" />
                            </form>

                            <!-- View Modal Trigger -->
                            <flux:modal.trigger name="view-product-{{ $product->id }}">
                                <flux:button icon="eye" variant="subtle" size="xs" square tooltip="View" />
                            </flux:modal.trigger>

                           <!-- View Modal -->
                           <flux:modal name="view-product-{{ $product->id }}" class="w-full max-w-3xl">
                                <div class="space-y-6">
                                    <!-- Header -->
                                    <div>
                                        <flux:heading size="xl">{{ $product->productName }}</flux:heading>
                            
                                    </div>

                                    <!-- Table of Product Info -->
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border-separate space-y-4">
                                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                <tr>
                                                    <th class="w-1/3 font-medium py-2 pr-4 align-top">Category</th>
                                                    <td class="py-2">{{ $product->category }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-medium py-2 pr-4 align-top">Size</th>
                                                    <td class="py-2">{{ $product->sizes }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-medium py-2 pr-4 align-top">Min Price (RM)</th>
                                                    <td class="py-2">RM {{ number_format($product->min_price, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="font-medium py-2 pr-4 align-top">Max Price (RM)</th>
                                                    <td class="py-2">RM {{ number_format($product->max_price, 2) }}</td>
                                                </tr> 
                                                <tr>
                                                    <th class="font-medium py-2 pr-4 align-top">Description</th>
                                                    <td class="py-2">{{ $product->description }}</td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="md:w-1/2">
                                            <div class="h-20 overflow-y-auto p-2 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-zinc-700">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-white mt-2 mb-2">Product Images</label>
                                                <div class="flex flex-wrap gap-2 py-2">
                                                    @foreach (json_decode($product->image_url, true) as $image)
                                                    <img 
                                                        src="{{ asset('storage/' . $image) }}" 
                                                        alt="Product Image"
                                                        class="w-20 h-20 object-cover rounded shadow border dark:border-gray-600"
                                                    />
                                                    @endforeach
                                                </div>
                                            </div>   
                                            </div>
                                            </div>
                                        </div>
                                   

                                    <!-- Footer -->
                                    <div class="flex justify-end pt-4 mt-2">
                                        <flux:modal.close>
                                            <flux:button variant="filled">Close</flux:button>
                                        </flux:modal.close>
                                    </div>
                                </div>
                            </flux:modal>
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            
            
            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
            </div>
        </div>
    </div>

</x-layouts.app>

</body>
</html>
