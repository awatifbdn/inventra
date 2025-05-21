

<x-layouts.app :title="__('Inventory')">
   
    @include('inventory.nav-tabs')
    
    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-white">Inventory</h1>
        </div>

    <div>
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Stock Update History</h2>
            <div class="container w-full px-4 sm:px-6 lg:px-8 py-6 mt-6">
                <!-- Header + Date Filter -->
                <form method="GET" action="{{ route('inventory.history') }}" class="flex gap-4 items-end mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">From Date</label>
                        <input type="date" name="from_date" value="{{ old('from_date', $from_date) }}" class="p-2 border rounded-md" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white mb-1">To Date</label>
                        <input type="date" name="to_date" value="{{ old('to_date', $to_date) }}" class="p-2 border rounded-md" />
                    </div>
                    <div>
                       <flux:button type="submit" variant="primary" icon="magnifying-glass" class="mt-6">
                        </flux:button>
                    </div>
                </form>


              <!-- Stock Update History -->
              <div class="w-full overflow-x-auto rounded-lg shadow-md">
                <table class="w-full text-sm text-left table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-white uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Note</th>
                            <th class="px-4 py-3">Recorded At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($history as $entry)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-300">
                                    {{ $loop->iteration + ($history->currentPage() - 1) * $history->perPage() }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                    {{ $entry->inventory->productName }}
                                </td>
                                <td class="px-4 py-3">{{ $entry->inventory->category }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ $entry->entry_type === 'in' 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                            : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $entry->entry_type === 'in' ? 'Stock In' : 'Stock Out' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $entry->quantity }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($entry->entry_date)->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">{{ $entry->note ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-300">{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center px-4 py-6 text-gray-400 dark:text-gray-500">
                                    No history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4 px-4">
                    {{ $history->links('vendor.pagination.tailwind') }}
                </div>
            </div>

    </div>
</x-layouts.app>