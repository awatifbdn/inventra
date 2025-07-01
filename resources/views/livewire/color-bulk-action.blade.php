<div x-data="colorTable()" class="mt-4">
    <!-- Select All -->
    <label>
        <input type="checkbox" x-model="selectAll" @change="toggleAll">
        Select All
    </label>

    <button wire:click="adjustPrice" @if(count($selected) === 0) disabled @endif>Adjust Price</button>
    <button wire:click="deleteSelected" @if(count($selected) === 0) disabled @endif>Delete</button>
</div>
