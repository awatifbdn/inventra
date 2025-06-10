@props(['productId', 'colorIds'])

<div
    x-data="priceManager({{ Js::from($colorIds) }}, '{{ route('colors.bulkDelete', ['product' => $productId]) }}', '{{ route('colors.adjustPrice', ['product' => $productId]) }}')"
    x-init="$watch('selected', () => updateMasterCheckbox($refs.masterCheckbox))"
    class="my-4 bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 p-4 rounded-xl flex flex-wrap items-center gap-4"
>
    <input type="checkbox"
           x-ref="masterCheckbox"
           @change="toggleAll($event.target.checked); $refs.adjustPriceButton.disabled = !($event.target.checked)"
           :checked="selected.length === all.length"
           class="mr-2 text-blue-600">
    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Select All</span>

    <button
        x-bind:disabled="selected.length === 0"
        @click="openAdjustModal()"
        x-ref="adjustPriceButton"
        class="ml-auto px-3 py-1.5 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 disabled:opacity-50"
    >
        Adjust Price
    </button>

    <form method="POST" :action="deleteUrl" x-ref="deleteForm" class="inline">
        @csrf
        @method('DELETE')
        <input type="hidden" name="ids" :value="selected.join(',')">
        <button
            type="submit"
            x-bind:disabled="selected.length === 0"
            class="px-3 py-1.5 bg-red-600 text-white rounded text-xs hover:bg-red-700 disabled:opacity-50"
            onclick="return confirm('Delete selected colors?')"
        >
            Delete Selected
        </button>
    </form>
    <x-color.adjust-price-modal />
</div>
