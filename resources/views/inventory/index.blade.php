<x-layouts.app :title="__('Inventory')">
    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-white">Inventory</h1>
          
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
        <!-- Button Section -->
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
                    <form @submit.prevent="addStock">
                        <div class="space-y-4 p-4">
                            <h3 class="text-lg font-semibold text-white dark:text-gray-700">Add New Product</h3><br>

                            <!-- Product Name -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-4">Product Name</label>
                                <flux:input type="text" name="product_name" x-model="newProduct.name" placeholder="e.g., Super Gloss Paint" />
                            </div>

                            <!-- Initial Quantity -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Initial Quantity</label>
                                <flux:input type="number" min="1" name="initial_quantity" x-model.number="newProduct.quantity" placeholder="e.g., 50" />
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Category</label>
                                <flux:select x-model="newProduct.category">
                                    <option value="" disabled selected>Select category</option>
                                    <option value="Interior">Interior</option>
                                    <option value="Exterior">Exterior</option>
                                    <option value="Metal">Metal</option>
                                    <option value="Wood">Wood</option>
                                </flux:select>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Color</label>
                                <flux:input type="text" name="color" x-model="newProduct.color" placeholder="e.g., Blue" />
                            </div>

                            <!-- Litre Size -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Litre Size</label>
                                <flux:input type="number" min="0.5" step="0.5" name="litre" x-model.number="newProduct.litre" placeholder="e.g., 5" />
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Notes</label>
                                <flux:input type="text" name="notes" x-model="newProduct.notes" placeholder="Optional notes..." />
                            </div>

                            <!-- Submit Button -->
                            <div class="text-right pt-2 mb-2">
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
                    <form @submit.prevent="submitStockUpdate">
                        <div class="space-y-4 p-4">
                            <h3 class="text-lg font-semibold text-white">Update Stock</h3><br>

                            <!-- Product Selector -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-1">Select Product</label>
                                <flux:select x-model="selectedProductCode" name="product">
                                    <option value="" disabled selected>Select product</option>
                                    <template x-for="product in products" :key="product.code">
                                        <option :value="product.code" x-text="product.name"></option>
                                    </template>
                                </flux:select>
                            </div>

                            <!-- Quantity Received -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-1">Quantity Received</label>
                                <flux:input type="number" min="1" name="quantity" x-model.number="receivedQuantity" placeholder="e.g., 10" />
                            </div>

                            <!-- Date Received -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-white mb-1">Date Received</label>
                                <flux:input type="datetime-local" name="date" x-model="receivedDate" />
                            </div>

                            <!-- Submit Button -->
                            <div class="text-right pt-2 mb-4">
                                <flux:button type="submit" variant="primary" icon="check">
                                    Submit Update
                                </flux:button>
                            </div>
                        </div>
                    </form>
                </flux:modal>    
            </div>

            <!-- Search and Filter Form -->
            <form action="#" method="GET" class="flex flex-wrap items-center gap-4 justify-end">
                
                <!-- Category Dropdown -->
                <div class="relative">
                    <label for="category" class="sr-only">Category</label>
                    <select name="category" id="category"
                        class="block w-48 rounded-lg border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm text-gray-700 dark:text-white px-4 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        <option value="furniture">Furniture</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
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
                    <!-- Sample Row 1 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">1</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">P003</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Gloss Enamel</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Metal</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Red</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">1</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">0</td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Out of stock</td>

                    <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                        <!-- Edit Button with update product form -->
                        <flux:modal.trigger name="edit-product">
                            <flux:button icon="pencil" variant="primary" size="xs" square tooltip="Edit" />
                        </flux:modal.trigger>


                        <!-- Delete Button -->
                        <flux:button icon="trash" variant="danger" size="xs" square tooltip="Delete" />
                    </td>

                    </tr>
                </tbody>
            </table>
        </div>
            </div>
    
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 mt-6">
                <!-- Header + Date Filter -->
                <div class="flex flex-col sm:flex-row items-start sm:items-left justify-between gap-4 mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Stock History Logs</h2>
                    
                    <div class="flex items-center gap-2">
                    <label for="date" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Date:</label>
                    <input id="date" name="date" type="date"
                        class="px-4 py-2 rounded-lg border dark:border-neutral-600 bg-white dark:bg-neutral-800 text-sm text-gray-900 dark:text-white shadow-sm focus:ring-2 focus:ring-blue-500" />
                    </div>
                </div>

                <!-- History Logs List -->
                <ul class="bg-white dark:bg-zinc-800 border border-neutral-300 dark:border-neutral-700 rounded-xl divide-y divide-neutral-200 dark:divide-neutral-700 text-sm shadow-md">
                    <!-- Example Log Entry -->
                    <li class="flex items-start sm:items-center px-4 py-4 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
                    <div class="mr-3 mt-0.5 text-green-600 dark:text-green-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 dark:text-white">Added <strong>20 units</strong> of Acrylic Wall Paint</p>
                        <div class="text-gray-500 text-xs mt-1">May 15, 2025 · 09:20 AM</div>
                    </div>
                    <span class="ml-4 px-2 py-0.5 text-xs rounded-full bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300">Added</span>
                    </li>

                    <li class="flex items-start sm:items-center px-4 py-4 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
                    <div class="mr-3 mt-0.5 text-yellow-600 dark:text-yellow-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h12a2 2 0 002-2V9l-7-4z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 dark:text-white">Updated stock for <strong>Weather Shield</strong></p>
                        <div class="text-gray-500 text-xs mt-1">May 14, 2025 · 04:00 PM</div>
                    </div>
                    <span class="ml-4 px-2 py-0.5 text-xs rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300">Updated</span>
                    </li>
                </ul>
                </div>
    </div>
</x-layouts.app>

