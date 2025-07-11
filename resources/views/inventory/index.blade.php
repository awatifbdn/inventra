<x-layouts.app :title="__('Inventory')">
    @include('inventory.nav-tabs')

    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Page Heading -->
   

 <div class="grid gap-6 mt-10 md:grid-cols-3">
    <!-- Total Stock -->
    <div style="
        background: linear-gradient(135deg, #ffffff, #f5f1b1);
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        padding: 1.5rem;
       
    ">
        <div style="position:absolute; right:1rem; top:1rem; opacity:0.1;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#999999" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #444;">Total Stock</h2>
        <p style="font-size: 2rem; font-weight: 700; margin-top: 0.5rem; color: #1a1a1a;">{{ number_format($total_stock) }}</p>
        <p style="font-size: 0.875rem; margin-top: 0.25rem; color: #666;">Increased by 8%</p>
    </div>

    <!-- Low Stock -->
    <div style="
        background: linear-gradient(135deg, #ffffff, #f5f1b1);
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        padding: 1.5rem;
       
    ">
        <div style="position:absolute; right:1rem; top:1rem; opacity:0.1;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#999999" viewBox="0 0 24 24">
                <path d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
            </svg>
        </div>
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #444;">Low Stock</h2>
        <p style="font-size: 2rem; font-weight: 700; margin-top: 0.5rem; color: #1a1a1a;">{{ number_format($low_stock) }}</p>
        <p style="font-size: 0.875rem; margin-top: 0.25rem; color: #666;">Decreased by 10%</p>
    </div>

    <!-- Out of Stock -->
    <div style="
        background: linear-gradient(135deg,  #ffffff, #f5f1b1);
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        padding: 1.5rem;
       
    ">
        <div style="position:absolute; right:1rem; top:1rem; opacity:0.1;">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#999999" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3" />
            </svg>
        </div>
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #444;">Out of Stock</h2>
        <p style="font-size: 2rem; font-weight: 700; margin-top: 0.5rem; color: #1a1a1a;">{{ number_format($out_of_stock) }}</p>
        <p style="font-size: 0.875rem; margin-top: 0.25rem; color: #666;">Decreased by 2%</p>
    </div>
</div>




        <!-- Actions + Filters -->
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <flux:modal.trigger name="add-product">
                    <flux:button variant="primary" size="sm" icon="plus"
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Add Product
                    </flux:button>
                </flux:modal.trigger>

                <flux:modal.trigger name="update-stock">
                    <flux:button variant="primary" size="sm" icon="pencil"
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Update Stock
                    </flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Search & Filter Form -->
            <form action="{{ route('inventory.search') }}" method="GET" class="flex flex-wrap gap-3 items-center">
                <select name="category"
                    class="w-48 rounded-md border border-gray-300 text-gray-700 px-3 py-2 focus:ring focus:ring-yellow-300">
                    <option value="">All Categories</option>
                    <option value="Interior" {{ request('category') == 'Interior' ? 'selected' : '' }}>Interior</option>
                    <option value="Exterior" {{ request('category') == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                    <option value="Protective coatings" {{ request('category') == 'Protective coatings' ? 'selected' : '' }}>Protective coatings</option>
                    <option value="Sports, courts, coatings" {{ request('category') == 'Sports, courts, coatings' ? 'selected' : '' }}>Sports, courts, coatings</option>
                    <option value="Waterproofing solutions" {{ request('category') == 'Waterproofing solutions' ? 'selected' : '' }}>Waterproofing solutions</option>
                </select>

                <div class="flex-1 min-w-xs">
                    <flux:input name="search" placeholder="Search products..." />
                </div>

                <flux:button icon="magnifying-glass" type="submit" variant="primary">
                    Search
                </flux:button>
            </form>
        </div>

        <!-- Inventory Table -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full text-sm divide-y divide-gray-200">
                <thead class=" text-gray-700">
                    <tr style="background-color: #e8e9e9;">
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Product Code</th>
                        <th class="px-4 py-3 text-left font-semibold">Product Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Category</th>
                        <th class="px-4 py-3 text-left font-semibold">Color</th>
                        <th class="px-4 py-3 text-left font-semibold">Litre</th>
                        <th class="px-4 py-3 text-left font-semibold">Pail Quantity</th>
                        <th class="px-4 py-3 text-left font-semibold">Notes</th>
                        <th class="px-4 py-3 text-center font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($inventory as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->productCode }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->productName }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->category }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->color }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->litre }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->pail_quantity }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $item->notes }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <flux:modal.trigger name="edit-stock-{{ $item->id }}">
                                    <flux:button icon="pencil" variant="primary" size="xs" square tooltip="Edit" />
                                </flux:modal.trigger>
                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" icon="trash" variant="danger" size="xs" square tooltip="Delete" />
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modern Add Product Modal -->
<flux:modal name="add-product" class="rounded-2xl shadow-xl bg-white">
    <div class="p-6 space-y-6">
        <h3 class="text-2xl font-semibold text-gray-800">Add New Product</h3>
        <p class="text-sm text-gray-500">Fill in the product details below.</p>
        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
            @csrf
            @method('POST')

            <flux:input name="productCode" label="Product Code" placeholder="e.g., 12345" />
            <flux:input name="productName" label="Product Name" placeholder="e.g., Super Gloss Paint" />
            <flux:input name="pail_quantity" label="Pail Quantity" type="number" min="1" placeholder="e.g., 50" />

            <flux:select name="category" label="Category">
                <option value="" disabled selected>Select category</option>
                <option value="Interior">Interior</option>
                <option value="Exterior">Exterior</option>
                <option value="Glomel">Glomel</option>
                <option value="Protective coatings">Protective coatings</option>
                <option value="Sports, courts, coatings">Sports, courts, coatings</option>
                <option value="Waterproofing solutions">Waterproofing solutions</option>
            </flux:select>

            <flux:input name="color" label="Color" placeholder="e.g., Blue" />
            <flux:input name="litre" label="Litre Size" type="number" step="0.5" placeholder="e.g., 5" />
            <flux:input name="notes" label="Notes" placeholder="Optional notes..." />

            <div class="mt-6 flex justify-end gap-2">
                <flux:button as="button" type="button" variant="subtle" onclick="$modal.close()">Cancel</flux:button>
                <flux:button type="submit" variant="primary">Add Product</flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<!-- Modern Update Stock Modal -->
<flux:modal name="update-stock" class="rounded-2xl shadow-xl bg-white">
    <div class="p-6 space-y-6">
        <h3 class="text-2xl font-semibold text-gray-800">Update Stock</h3>
        <p class="text-sm text-gray-500">Search and update the stock for a product.</p>
        <form action="{{ route('inventory.updateStock') }}" method="POST" class="space-y-4" x-data="productSearch()">
            @csrf

            <flux:input name="search" label="Search Product" x-model="query" @input="filterStocks" placeholder="Type product name or code..." />
            <flux:select name="entry_type" label="Entry Type">
                <option value="in">Stock In</option>
                <option value="out">Stock Out</option>
            </flux:select>
            <flux:input name="quantity" label="Quantity" type="number" min="1" placeholder="e.g., 10" />
            <flux:input name="entry_date" label="Date" type="datetime-local" />
            <flux:input name="note" label="Note" placeholder="Optional note..." />

            <div class="mt-6 flex justify-end gap-2">
                <flux:button as="button" type="button" variant="subtle" onclick="$modal.close()">Cancel</flux:button>
                <flux:button type="submit" variant="primary">Submit Update</flux:button>
            </div>
        </form>
    </div>
</flux:modal>

    </div>
</x-layouts.app>
