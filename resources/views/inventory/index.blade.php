
<x-layouts.app :title="__('Inventory')">
     @include('inventory.nav-tabs')

    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl mt-6 font-semibold text-white">Inventory</h1>
        </div>

        <!-- Dashboard Stats -->
         <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="p-6 rounded-xl border-gray-300 dark:border-zinc-600 bg-yellow-200 dark:bg-gray-800 shadow-md">
                <h2 class="text-lg font-semibold">Total Stock</h2>
                <p class="text-2xl font-bold text-green-600 mt-2">1,250</p>
            </div>
            <div class="p-6 rounded-xl  border-gray-300 dark:border-zinc-600 bg-yellow-200 dark:bg-gray-800 shadow-md" >
                <h2 class="text-lg font-semibold">Low Stock</h2>
                <p class="text-2xl font-bold text-yellow-500 mt-2">75</p>
            </div>
            <div class="p-6 rounded-xl  border-gray-300 dark:border-zinc-600 bg-yellow-200 dark:bg-gray-800 shadow-md">
                <h2 class="text-lg font-semibold">Out of Stock</h2>
                <p class="text-2xl font-bold text-red-500 mt-2">12</p>
            </div>
        </div>
        <!-- Button Section.. -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            
            <!-- Left-side Buttons -->
            <div class="flex gap-3">
                <flux:modal.trigger name="add-product">
                    <flux:button variant="primary" size="sm" icon="plus" 
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-6 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Add Product
                    </flux:button>
                </flux:modal.trigger>

                <!-- Add Product Modal -->
                <flux:modal name="add-product">
                    <form action="{{ route('inventory.store') }}" method="POST">
                        @csrf   
                        @method('POST')
                        <div class="space-y-4 p-4">
                            <h3 class="text-lg font-semibold dark:text-white text-gray-700">Add New Product</h3><br>

                            <!-- Product Code -->
                            <div>
                                <label class="block text-sm font-medium  dark:text-white text-gray-700 mb-2 ">Product Code</label>
                                <flux:input type="text" name="productCode" placeholder="e.g., 12345" />
                            </div>

                            <!-- Product Name -->
                            <div>
                                <label class="block text-sm font-medium  dark:text-white text-gray-700 mb-2 mt-3">Product Name</label>
                                <flux:input type="text" name="productName"  placeholder="e.g., Super Gloss Paint" />
                            </div>

                            <!-- Initial Quantity -->
                            <div>
                                <label class="block text-sm font-medium   dark:text-white text-gray-700 mb-2 mt-3">Pail Quantity</label>
                                <flux:input type="number" min="1" name="pail_quantity" placeholder="e.g., 50" />
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium   dark:text-white text-gray-700 mb-2 mt-3">Category</label>
                                <flux:select name="category" >
                                    <option value="" disabled selected>Select category</option>
                                    <option value="Interior">Interior</option>
                                    <option value="Exterior">Exterior</option>
                                    <option value="Glomel">Glomel</option>
                                    <option value="Protective coatings">Protective coatings</option>
                                    <option value="Sports, courts, coatings">Sports, courts, coatings</option>
                                    <option value="Waterproofing solutions">Waterproofing solutions</option>
                                </flux:select>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block text-sm font-medium  dark:text-white text-gray-700 mb-2 mt-3">Color</label>
                                <flux:input type="text" name="color" placeholder="e.g., Blue" />
                            </div>

                            <!-- Litre Size -->
                            <div>
                                <label class="block text-sm font-medium  dark:text-white text-gray-700 mb-2 mt-3">Litre Size</label>
                                <flux:input type="number" min="0.5" step="0.5" name="litre" placeholder="e.g., 5" />
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm font-medium  dark:text-white text-gray-700 mb-2 mt-3">Notes</label>
                                <flux:input type="text" name="notes" placeholder="Optional notes..." />
                            </div>

                            <!-- Submit Button -->
                            <div class="text-right pt-2 mt-4">
                                <flux:button type="submit" variant="primary" >
                                    Add Product
                                </flux:button>
                            </div>
                        </div>
                    </form>
                </flux:modal>


                <flux:modal.trigger name="update-stock">
                    <flux:button variant="primary" size="sm" icon="pencil"
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-6 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Update Stock
                    </flux:button>
                </flux:modal.trigger>

                <!-- Update Stock Modal -->
              <flux:modal name="update-stock">
                    <form action="{{ route('inventory.updateStock') }}" method="POST" x-data="productSearch()">
                        @csrf
                        <div class="space-y-4 p-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Update Stock</h3><br>

                            <!-- Live Search -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Search Product</label>
                                <input 
                                    type="text" 
                                    class="w-full p-2 rounded-md border border-gray-300"
                                    placeholder="Type product name or code..."
                                    x-model="query"
                                    @click.away="filtered = []"
                                    @input="filterStocks"
                                   
                                />
                               <ul class="mt-2 text-sm rounded-md border-gray-500 shadow-md max-h-48 overflow-y-auto" role="listbox">
                                <template x-for="stock in filtered" :key="stock.id">
                                    <li 
                                    class="p-2 hover:text-green-800 cursor-pointer text-gray-900 dark:text-white" role="option"
                                    @click="selectStocks(stock)"
                                    x-text="stock.productName + ' (' + stock.productCode + ')'">
                                    </li>
                                </template>
                                </ul>

                                <input type="hidden" name="stock_id" :value="selected?.id">
                                <div class="text-xs text-gray-900 dark:text-white mt-1" x-show="selected">Selected: <span x-text="selected.productName"></span></div>
                            </div>

                            <!-- Entry Type -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Entry Type</label>
                                <select name="entry_type" class="w-full p-2 rounded-md border border-gray-300">
                                    <option value="in">Stock In</option>
                                    <option value="out">Stock Out</option>
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium  text-gray-700 dark:text-white mb-1">Quantity Received</label>
                                <flux:input type="number" min="1" name="quantity" placeholder="e.g., 10" />
                            </div>

                            <!-- Date -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium  text-gray-700 dark:text-white mb-1">Date Received</label>
                                <flux:input type="datetime-local" name="entry_date" />
                            </div>

                            <!-- Optional Note -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Note (Optional)</label>
                                <flux:input type="text" name="note" placeholder="e.g., Shipment received from supplier" />
                            </div>


                            <!-- Submit -->
                            <div class="text-right pt-2 mb-4">
                                <flux:button type="submit" variant="primary">Submit Update</flux:button>
                            </div>
                        </div>
                    </form>
                </flux:modal>

               <script>
                function productSearch() {
                    return {
                        query: '',
                        selected: null,
                        products: @json($inventory ?? []),
                        filtered: [],
                        filterStocks() {
                            const q = this.query.toLowerCase();
                            this.filtered = this.products.filter(p =>
                                p.productName.toLowerCase().includes(q) ||
                                p.productCode.toLowerCase().includes(q)
                            );
                        },
                        selectStocks(stock) {
                            this.selected = stock;
                            this.query = stock.productName + ' (' + stock.productCode + ')';
                            this.filtered = [];
                        }
                    }
                }
            </script>



  
            </div>

            <!-- Search and Filter Form -->
            <form action="#" method="GET" class="flex flex-wrap items-center gap-4 justify-end">
                
                <!-- Category Dropdown -->
                <div class="relative">
                    <label for="category" class="sr-only">Category</label>
                    <select name="category" id="category"
                        class="block w-48 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm text-gray-700 dark:text-white px-4 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        <option value="Interior">Interior</option>
                        <option value="Exterior">Exterior</option>
                        <option value="Protective coatings">Protective coatings</option>
                        <option value="Sports, courts, coatings">Sports, courts, coatings</option>
                        <option value="Waterproofing solutions">Waterproofing solutions</option>
                    </select>
                </div>

                <!-- Search Input -->
                <div class="flex-1 min-w-xs">
                    <flux:input name="search" placeholder="Search products..." />
                </div>

                <!-- Search Button -->
                <div>
                    <flux:button icon="magnifying-glass" type="submit" variant="primary">
                        <span class="hidden sm:inline">Search</span>
                    </flux:button>
                </div>

            </form>
        </div>

            </div>

         <!-- Inventory Table -->
       
            <div class="p-2">
              <div class="overflow-x-auto max-w-max bg-white dark:bg-zinc-800 rounded shadow">
                    <table class="w-full text-sm text-center table-auto">
                        <thead class="bg-zinc-200 dark:bg-zinc-700">
                            <tr class="text-gray-700 dark:text-white uppercase">
                                <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Product Code</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Product Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Category</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Color</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Litre</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Pail Quantity</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Notes</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                            @foreach ($inventory as $index => $inventory)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->productCode }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->productName }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->category }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->color }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->litre }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->pail_quantity }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $inventory->notes }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 flex items-center justify-center gap-2">
                                    <!-- Edit Button with update product form -->
                                    <flux:modal.trigger name="">
                                        <flux:button icon="pencil" variant="primary" size="xs" square tooltip="Edit" />
                                    </flux:modal.trigger>

                                    <flux:modal name="">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="space-y-4 p-4">
                                                <h3 class="text-lg font-semibold text-white">Edit Product</h3><br>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Product Name</label>
                                                    <flux:input type="text" name="productName" value="" />
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Category</label>
                                                    <flux:select name="category" >
                                                        <option value="Interior" >Interior</option>
                                                        <option value="Exterior">Exterior</option>
                                                        <option value="Metal" >Metal</option>
                                                        <option value="Wood">Wood</option>
                                                    </flux:select>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Color</label>
                                                    <flux:input type="text" name="color" value="" />
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Litre Size</label>
                                                    <flux:input type="number" min="0.5" step="0.5" name="litre" value="" />
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Pail Quantity</label>
                                                    <flux:input type="number" min="0" name="pail_quantity" value="" />
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-white mb-1">Notes</label>
                                                    <flux:input type="text" name="notes" value="" />
                                                </div>

                                                <div class="text-right pt-2 mb-2">
                                                    <flux:button type="submit" variant="primary">Update Product</flux:button>
                                                </div>
                                            </div>
                                        </form>
                                    </flux:modal>

                                    <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" icon="trash" variant="danger" size="xs" square tooltip="Delete" />
                                </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
          
            <br class="line-separator ">
           
            
                </div>
    </div>
</x-layouts.app>

