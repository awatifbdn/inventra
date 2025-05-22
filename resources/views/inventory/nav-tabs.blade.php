<!-- resources/views/inventory/nav-tabs.blade.php -->

<div class="flex border-b border-gray-700">
    <a href="{{ route('inventory.index') }}"
       class="px-4 py-2 -mb-px text-sm font-medium border-b-2 {{ request()->routeIs('inventory.index') ? 'border-yellow-400 text-yellow-400' : 'border-transparent text-white hover:text-yellow-300' }}">
        Stock Inventory
    </a>
    <a href="{{ route('inventory.history') }}"
       class="px-4 py-2 -mb-px text-sm font-medium border-b-2 {{ request()->routeIs('inventory.history') ? 'border-yellow-400 text-yellow-400' : 'border-transparent text-white hover:text-yellow-300' }}">
        Stock History
    </a>
</div>
