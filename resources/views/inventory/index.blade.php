<x-layouts.app :title="__('Inventory')">
    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-white">Inventory</h1>
          
        </div>

        <!-- Dashboard Stats -->
         <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="p-6 rounded-xl border-gray-300 dark:border-zinc-600 bg-white dark:bg-gray-800 shadow-md">
                <h2 class="text-lg font-semibold">Total Stock</h2>
                <p class="text-2xl font-bold text-green-600 mt-2">1,250</p>
            </div>
            <div class="p-6 rounded-xl  border-gray-300 dark:border-zinc-600 bg-white dark:bg-gray-800">
                <h2 class="text-lg font-semibold">Low Stock</h2>
                <p class="text-2xl font-bold text-yellow-500 mt-2">75</p>
            </div>
            <div class="p-6 rounded-xl  border-gray-300 dark:border-zinc-600 bg-white dark:bg-gray-800">
                <h2 class="text-lg font-semibold">Out of Stock</h2>
                <p class="text-2xl font-bold text-red-500 mt-2">12</p>
            </div>
        </div>

         <!-- Search and Filter Form -->
            <form action="#" method="GET" class="mb-6 flex flex-wrap items-center gap-4 justify-end search-form">
                  <flux:modal.trigger name="update-stock">
                    <flux:button variant="primary" size="sm" icon="plus">Update Stock</flux:button>
                </flux:modal.trigger>

                <!-- Category Dropdown (still native) -->
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

                <!-- Search Input (Flux) -->
                <div class="flex-1 min-w-xs">
                    <flux:input name="search" placeholder="Search products..." />
                </div>

                <!-- Submit Button (Flux) -->
                <div>
                    <flux:button icon="magnifying-glass" type="submit" variant="primary">
                        <span class="hidden sm:inline">Search</span>
                    </flux:button>
                </div>

            </form>

         <!-- Inventory Table -->
       
            <div class="p-2">
               <div class="overflow-x-auto max-w-max bg-white dark:bg-zinc-800 rounded shadow">
            <table class="w-full text-sm text-left table-auto">
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
    

        <!-- History Logs -->
        <div class="mt-6">
            <h2 class="text-white font-semibold mb-2">Stock History Logs</h2>
            <ul class="bg-[#1a1a2b] border border-neutral-700 rounded-xl divide-y divide-neutral-600 text-sm text-white">
                <li class="px-4 py-3 hover:bg-neutral-800">
                    <a href="#" class="text-blue-400 hover:underline">Added 20 units of Acrylic Wall Paint</a> <span class="text-gray-400 ml-2">2025-05-15 09:20</span>
                </li>
                <li class="px-4 py-3 hover:bg-neutral-800">
                    <a href="#" class="text-blue-400 hover:underline">Updated stock for Weather Shield</a> <span class="text-gray-400 ml-2">2025-05-14 16:00</span>
                </li>
            </ul>
        </div>
    </div>
</x-layouts.app>
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


    <script>
         function inventoryDashboard() {
        return {
            search: '',
            openAddModal: false,
            receivedQuantity: 0,
            selectedProductCode: '',
            receivedDate: '',
            newProduct: {
                name: '',
                quantity: 0
            },
            logs: [
                { message: 'Added 20 units of Acrylic Wall Paint', timestamp: '2025-05-15 09:20' },
                { message: 'Updated stock for Weather Shield', timestamp: '2025-05-14 16:00' },
            ],
            products: [
                { code: 'P001', name: 'Acrylic Wall Paint', category: 'Interior', color: 'White', litre: 5, quantity: 30, notes: 'Popular item' },
                { code: 'P002', name: 'Weather Shield', category: 'Exterior', color: 'Blue', litre: 10, quantity: 12, notes: 'Limited stock' },
                { code: 'P003', name: 'Gloss Enamel', category: 'Metal', color: 'Red', litre: 1, quantity: 0, notes: 'Out of stock' },
            ],

            get filteredProducts() {
                return this.search
                    ? this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()))
                    : this.products;
            },

            submitStockUpdate() {
                const product = this.products.find(p => p.code === this.selectedProductCode);
                if (!product || this.receivedQuantity <= 0) return;

                // Update quantity
                product.quantity += this.receivedQuantity;

                // Use specified date or now
                const date = this.receivedDate
                    ? new Date(this.receivedDate).toLocaleString()
                    : new Date().toLocaleString();

                // Add to logs
                this.logs.unshift({
                    message: `Received ${this.receivedQuantity} units of ${product.name}`,
                    timestamp: date
                });

                // Reset modal inputs
                this.receivedQuantity = 0;
                this.selectedProductCode = '';
                this.receivedDate = '';
            },

            addStock() {
                this.products.push({
                    code: `P00${this.products.length + 1}`,
                    name: this.newProduct.name,
                    category: 'Interior',
                    color: 'Gray',
                    litre: 5,
                    quantity: parseInt(this.newProduct.quantity),
                    notes: 'Newly added'
                });
                this.logs.unshift({
                    message: `Added ${this.newProduct.quantity} of ${this.newProduct.name}`,
                    timestamp: new Date().toLocaleString()
                });
                this.newProduct = { name: '', quantity: 0 };
                this.openAddModal = false;
            }
        };
    }
    </script>

