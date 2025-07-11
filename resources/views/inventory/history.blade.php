<x-layouts.app :title="__('Inventory')">
    @include('inventory.nav-tabs')

    <div class="flex w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- Top Bar -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl mt-6 font-semibold text-gray-800">📜 Stock Update History</h1>
        </div>

        <div class="container w-full px-4 sm:px-6 lg:px-8 py-6 mt-6">
            <!-- Header + Date Filter -->
            <form method="GET" action="{{ route('inventory.history') }}" class="flex flex-wrap gap-4 items-end mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                    <input type="date" name="from_date" value="{{ old('from_date', $from_date) }}" class="p-2 border border-gray-300 rounded-md w-48 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                    <input type="date" name="to_date" value="{{ old('to_date', $to_date) }}" class="p-2 border border-gray-300 rounded-md w-48 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <flux:button type="submit" variant="primary" icon="magnifying-glass" class="mt-6">
                        Filter
                    </flux:button>
                </div>
            </form>

            <!-- Stock Update History Table -->
            <div class="w-full overflow-x-auto rounded-lg shadow border border-gray-200">
                <table class="w-full text-sm text-left table-auto">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wide">
                        <tr style="background-color: #e8e9e9;">
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
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($history as $entry)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $loop->iteration + ($history->currentPage() - 1) * $history->perPage() }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $entry->inventory->productName }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $entry->inventory->category }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $entry->entry_type === 'in' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $entry->entry_type === 'in' ? 'Stock In' : 'Stock Out' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $entry->quantity }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ \Carbon\Carbon::parse($entry->entry_date)->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $entry->note ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $entry->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center px-4 py-6 text-gray-400">
                                    No history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    Showing {{ $history->firstItem() }} to {{ $history->lastItem() }} of {{ $history->total() }} entries
                </p>
                <div>
                    {{ $history->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
