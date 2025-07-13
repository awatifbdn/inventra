<flux:modal name="edit-color-{{ $color->id }}">
    <div class="p-6 space-y-6">
        <h2 class="text-2xl font-semibold text-gray-900">Edit Color</h2>
        <p class="text-sm text-gray-500">Update the color details and pricing below.</p>

        <form action="{{ route('colors.update', ['product' => $product->id, 'color' => $color->id]) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Color Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Color Name" name="color_name" value="{{ $color->color_name }}" required />
                <flux:input label="Color Code (e.g. #ff0000)" name="color_code" value="{{ $color->color_code }}" required />
                <flux:input type="file" label="Color Pallet (optional)" name="color_pallet" />
            </div>

            <!-- Dynamic Size & Price Inputs -->
            <div
                x-data='{
                    sizes: @json($color->litres->map(fn($l) => [
                        "litre" => $l->litre,
                        "price" => $l->price
                    ])),
                    remove(index) {
                        if (this.sizes.length > 1) this.sizes.splice(index, 1);
                    }
                }'
                class="space-y-4 border border-gray-200 p-4 rounded-xl bg-gray-50"
            >
                <h3 class="text-md font-semibold text-gray-700">Litre & Price Options</h3>

                <template x-for="(size, index) in sizes" :key="index">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end relative">
                        <div class="relative mt-2">
                            <div class="absolute top-0 right-0 mt-1.5 mr-1">
                                <flux:button icon="x-mark" variant="subtle" type="button"
                                             @click="remove(index)"
                                             x-show="sizes.length > 1">
                                </flux:button>
                            </div>
                            <flux:input 
                                :label="'Litre (L)'" 
                                :name="'litres[]'" 
                                x-model="size.litre" 
                                type="number" 
                                step="0.01"
                                class="mb-2 mt-4" 
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

                <div class="mt-4">
                    <flux:button 
                        type="button" 
                        variant="subtle" 
                        class="text-sm" 
                        @click="sizes.push({ litre: '', price: '' })">
                        + Add Size
                    </flux:button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-2">
                <flux:button type="submit" variant="primary">Update Color</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
