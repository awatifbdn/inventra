<div class="flex border-b border-gray-200">
    <a href="{{ route('inventory.index') }}"
       class="px-4 py-2 text-sm font-medium rounded-t-lg transition-all duration-200
           {{ request()->routeIs('inventory.index') 
               ? 'bg-white border border-gray-200 border-b-0 text-yellow-600 shadow-sm'
               : 'text-gray-600 hover:text-yellow-600 hover:bg-gray-50' }}">
        Stock Inventory
    </a>
    <a href="{{ route('inventory.history') }}"
       class="px-4 py-2 text-sm font-medium rounded-t-lg transition-all duration-200
           {{ request()->routeIs('inventory.history') 
               ? 'bg-white border border-gray-200 border-b-0 text-yellow-600 shadow-sm'
               : 'text-gray-600 hover:text-yellow-600 hover:bg-gray-50' }}">
        Stock History
    </a>
</div>
