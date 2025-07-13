<x-layouts.app :title="__('Inventory')">
    @include('inventory.nav-tabs')

    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

      <!-- 📊 Dashboard Stats -->
        @php
            $dashboardCards = [
                ['title' => 'Total Stock', 'value' => $total_stock, 'note' => 'All inventory counted', 'color' => '#d5fbd1', 'textColor' => '#16a34a'], // green
                ['title' => 'Low Stock', 'value' => $low_stock, 'note' => 'Reorder soon', 'color' => '#fff2cc', 'textColor' => '#ca8a04'], // yellow
                ['title' => 'Out of Stock', 'value' => $out_of_stock, 'note' => 'Needs urgent restock', 'color' => '#ffb3b3', 'textColor' => '#dc2626'], // red
            ];
        @endphp

        <div class="grid gap-6 mt-10 md:grid-cols-3">
            @foreach ($dashboardCards as $card)
                <div style="
                    background: linear-gradient(135deg, #ffffff, {{ $card['color'] }});
                    border-radius: 1rem;
                    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
                    position: relative;
                    overflow: hidden;
                    padding: 1.5rem;
                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                "
                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.12)'"
                onmouseout="this.style.transform=''; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'"
                >
                    <h2 style="font-size: 1.125rem; font-weight: 600; color: #444;">{{ $card['title'] }}</h2>

                    <p style="
                        font-size: 2rem;
                        font-weight: 800;
                        margin-top: 0.5rem;
                        color: {{ $card['textColor'] }};
                        letter-spacing: -1px;
                    ">

                        {{ number_format($card['value']) }}
                    </p>

                    <p style="font-size: 0.875rem; margin-top: 0.25rem; color: #666;">
                        {{ $card['note'] }}
                    </p>
                </div>
            @endforeach
        </div>



        <!-- 🚀 Actions + Filters -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mt-6">
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <flux:modal.trigger name="add-product">
                    <flux:button 
                        variant="primary" 
                        size="sm" 
                        icon="plus"
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition"
                    >
                        Add Product
                    </flux:button>
                </flux:modal.trigger>

                <flux:modal.trigger name="update-stock">
                    <flux:button 
                        variant="primary" 
                        size="sm" 
                        icon="pencil"
                        class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition"
                    >
                        Update Stock
                    </flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Search & Filter Form -->
            <form action="{{ route('inventory.search') }}" method="GET" class="flex flex-wrap gap-3 items-center">
                <select name="category" class="w-48 rounded-md border border-gray-300 text-gray-700 px-3 py-2 focus:ring focus:ring-yellow-300">
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

                <flux:button 
                    icon="magnifying-glass" 
                    type="submit" 
                    variant="primary"
                    class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition"
                >
                </flux:button>
            </form>
        </div>

        <!-- 📦 Inventory Table -->
        <div class="overflow-x-auto rounded-lg shadow mt-4">
            <table class="w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700">
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
                                    <flux:button 
                                        icon="pencil" 
                                        variant="ghost" 
                                        size="xs" 
                                        square 
                                        tooltip="Edit" 
                                    />
                                </flux:modal.trigger>
                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button 
                                        type="submit" 
                                        icon="trash" 
                                        variant="danger" 
                                        size="xs" 
                                        square 
                                        tooltip="Delete"
                                        class="bg-red-500 text-white hover:bg-red-600 transition"
                                    />
                                </form>
                            </div>
                        </td>
                    </tr>
                    @include('inventory.edit-inventory', ['item' => $item])
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 📄 Pagination -->
        <div class="mt-4">
            {{ $inventory->links() }}
        </div>

        <!-- ➕ Add Product Modal -->
        @include('inventory.modals.add-product')

        <!-- ✏️ Update Stock Modal -->
        @include('inventory.modals.update-stock')

    </div>
</x-layouts.app>
