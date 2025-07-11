<dialog x-ref="adjustModal" class="rounded shadow-lg p-6 max-w-md w-full bg-white border border-gray-300">
    <form method="POST" :action="adjustPriceUrl" class="space-y-4">
        @csrf
        <input type="hidden" name="ids" :value="selected.join(',')">

        <div>
            <h3 class="text-lg font-semibold text-gray-900">Adjust Prices</h3>
            <p class="text-sm text-gray-600">Adjust prices for the selected colors by percentage.</p>
        </div>

        <label class="block text-sm font-medium text-gray-700">Percentage Change (%)</label>
        <input type="number" name="percentage" min="-100" max="100" step="0.01"
               placeholder="E.g. 10 for +10%" required
               class="w-full px-3 py-2 rounded border border-gray-300 bg-white text-sm text-gray-800" />

        <div class="flex gap-2">
            <button type="submit" name="action" value="increase"
                    class="flex-1 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                Increase
            </button>
            <button type="submit" name="action" value="decrease"
                    class="flex-1 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                Decrease
            </button>
        </div>

        <button type="button" @click="$refs.adjustModal.close()" class="block text-xs text-gray-500 mt-2">Cancel</button>
    </form>
</dialog>
