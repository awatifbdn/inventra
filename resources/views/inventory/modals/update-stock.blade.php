<flux:modal name="update-stock" class="rounded-2xl shadow-xl bg-white">
    <div class="p-6 space-y-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-0.5">Update Stock</h3>
        <p class="text-sm text-gray-500">Search and update the stock for a product.</p>
        <form action="{{ route('inventory.updateStock') }}" method="POST" class="space-y-4" x-data="liveProductSearch()">
            @csrf
          
            <!-- 🌟 Beautiful Live Search -->
            <div class="relative">
                <flux:input 
                    name="product_search" 
                    label="Search Product" 
                    placeholder="Type product name or code..." 
                    x-model="query"
                    @input.debounce.300ms="fetchProducts"
                    @keydown.arrow-down.prevent="highlightNext()"
                    @keydown.arrow-up.prevent="highlightPrev()"
                    @keydown.enter.prevent="selectHighlighted()"
                />
                
                <!-- 🪄 Live Results Dropdown -->
                <div x-show="results.length > 0" 
                     class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                    <template x-for="(item, index) in results" :key="item.id">
                        <div 
                            :class="{
                                'px-4 py-2 cursor-pointer hover:bg-yellow-100': true,
                                'bg-yellow-200': highlightedIndex === index
                            }"
                            @click="selectProduct(item)"
                            @mouseenter="highlightedIndex = index"
                            x-text="item.productCode + ' - ' + item.productName"
                        ></div>
                    </template>
                </div>
            </div>

            <!-- Hidden field for selected product -->
            <input type="hidden" name="product_id" :value="selectedProductId" required>
            <br>
            <flux:select name="entry_type" label="Entry Type">
                <option value="in">Stock In</option>
                <option value="out">Stock Out</option>
            </flux:select>
            <br>
            <flux:input name="quantity" label="Quantity" type="number" min="1" placeholder="e.g., 10" />
            <br>
            <flux:input name="entry_date" label="Date" type="datetime-local" />
            <br>
            <flux:input name="note" label="Note" placeholder="Optional note..." />

            <div class="mt-6 flex justify-end gap-2">
                <flux:button as="button" type="button" variant="subtle" onclick="$modal.close()">Cancel</flux:button>
                <flux:button 
                    type="submit" 
                    variant="primary"
                    class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition"
                >
                    Submit Update
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>

<script>
function liveProductSearch() {
    return {
        query: '',
        results: [],
        selectedProductId: '',
        highlightedIndex: -1,

        fetchProducts() {
            if (this.query.length < 2) {
                this.results = [];
                return;
            }
            fetch(`/inventory/live-search?q=${encodeURIComponent(this.query)}`)
                .then(response => response.json())
                .then(data => {
                    this.results = data;
                    this.highlightedIndex = -1;
                })
                .catch(error => console.error('Live search failed:', error));
        },

        selectProduct(item) {
            this.query = item.productCode + ' - ' + item.productName;
            this.selectedProductId = item.id;
            this.results = [];
        },

        highlightNext() {
            if (this.highlightedIndex < this.results.length - 1) {
                this.highlightedIndex++;
            }
        },

        highlightPrev() {
            if (this.highlightedIndex > 0) {
                this.highlightedIndex--;
            }
        },

        selectHighlighted() {
            if (this.highlightedIndex >= 0) {
                this.selectProduct(this.results[this.highlightedIndex]);
            }
        }
    }
}
</script>
