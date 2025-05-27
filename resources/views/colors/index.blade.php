<x-layouts.app :title="'Manage Colors - ' . $product->productName">
    <div class="p-8 space-y-8">

<div class="flex flex-col md:flex-row items-center md:items-start gap-6 p-6 bg-white dark:bg-zinc-800 rounded-2xl border border-gray-200 dark:border-zinc-700 shadow-sm">

    {{-- Product Image --}}
    
  <div class="flex items-center gap-6 rounded-xl bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 shadow-sm p-6">
            <img src="{{ json_decode($product->image_url)[0] ?? asset('placeholder.jpg') }}" alt="Product Image"
                 class="w-32 h-32 object-cover rounded-xl border border-gray-300 dark:border-zinc-600">
  

    {{-- Product Info --}}
    <div class="flex-1 text-center md:text-left space-y-1">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $product->productName }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $product->category }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-300">Size: {{ $product->sizes }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-300">Price: <span class="font-medium text-blue-600 dark:text-blue-400">RM{{ $product->min_price }} - RM{{ $product->max_price }}</span></p>
    </div>

    {{-- Add Color Button --}}
    <div class="mt-4 md:mt-0">
        <flux:modal.trigger name="add-color">
            <flux:button variant="primary" icon="plus">Add Color</flux:button>
        </flux:modal.trigger>
    </div>
  </div>
</div>

        <!-- Main Content Grid -->
        <div class="space-y-6">
            <div class="flex justify-between items-center mt-6">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Available Colors</h3>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="rounded-full pl-4 pr-10 py-2 text-sm border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <span class="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500">&#128269;</span>
                    </div>
                 
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($product->colors as $color)
                    <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-sm">
                        <div class="w-10 h-10 rounded-full border border-gray-300 dark:border-zinc-600" style="background-color: {{ $color->color_pallet }}"></div>
                        <div>
                            <div class="font-semibold text-gray-800 dark:text-white">{{ $color->color_name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $color->color_code }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

      <flux:modal name="add-color">
    <div class="p-6 space-y-6">
        <!-- Modal Title -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Add New Color</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Fill in the color details and pricing for multiple sizes.</p>
        </div>

        <!-- Form Start -->
        <form method="POST" action="{{ route('colors.store', ['product' => $product->id]) }}" class="space-y-6">
            @csrf
            @method('POST')
            <!-- Basic Color Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Color Name" name="color_name" required />
                <flux:input label="Color Code (e.g. #ff0000)" name="color_code" required />
                <flux:input type="file" wire:model="attachments" label="Color Pallet" name="color_pallet" required />
            </div>

           <!-- Dynamic Size & Price Inputs -->
            <div 
                x-data="{
                    sizes: [{ litre: '', price: '' }],
                    remove(index) {
                        if (this.sizes.length > 1) this.sizes.splice(index, 1);
                    }
                }"
                class="space-y-4 border border-gray-200 dark:border-zinc-700 p-4 rounded-xl bg-gray-50 dark:bg-zinc-800"
            >
                <div class="flex justify-between items-center">
                    <h3 class="text-md font-semibold text-gray-700 dark:text-white">Litre & Price Options</h3>
                  
                </div>

                <template x-for="(size, index) in sizes" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end relative">
                        <div class="relative mt-2" >

                            
                            <!-- Per-row remove button -->
                            <div class="absolute top-0 right-0 mt-1.5 mr-1 mb-2 text-xs text-red-500 hover:text-red-700">
                            <flux:button icon="x-mark" variant="subtle"
                                type="button"
                                @click="remove(index)"
                                x-show="sizes.length > 1"
                            >
                                
                            </flux:button>
                        </div>

                            <flux:input 
                                :label="'Litre (L)'" 
                                :name="'litres[]'" 
                                x-model="size.litre" 
                                type="number" 
                                step="0.01"
                                class="mb-2" 
                                required 
                            />
                
                            <flux:input 
                                :label="'Price (RM)'" 
                                :name="'prices[]'" 
                                x-model="size.price" 
                                type="number" 
                                step="0.01" 
                                class="mb-2" 
                                required 
                            /> 

                    </div>
                         <flux:separator /> 
                    </div>
                </template>
                <div class="mt-4" >
                <flux:button 
                        type="button" 
                        variant="subtle" 
                        class="text-sm" 
                        @click="sizes.push({ litre: '', price: '' })" >
                        + Add Size
                    </flux:button>
                </div>
            </div>


            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <flux:button type="submit" variant="primary">Save Color</flux:button>
            </div>
        </form>
    </div>
</flux:modal>

    </div>
</x-layouts.app>
