 {{-- Add Color Modal --}}
        <flux:modal name="add-color">
            <div class="p-6 space-y-6">
                <!-- Modal Title -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Add New Color</h2>
                    <p class="text-sm text-gray-500">Fill in the color details and pricing for multiple sizes.</p>
                </div>

                <!-- Form Start -->
                <form method="POST" action="{{ route('colors.store', ['product' => $product->id]) }}" enctype="multipart/form-data" class="space-y-6">
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
                        class="space-y-4 border border-gray-200 p-4 rounded-xl bg-gray-50"
                    >
                        <div class="flex justify-between items-center">
                            <h3 class="text-md font-semibold text-gray-700">Litre & Price Options</h3>
                        </div>

                        <template x-for="(size, index) in sizes" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end relative">
                                <div class="relative mt-2">
                                    <!-- Per-row remove button -->
                                    <div class="absolute top-0 right-0 mt-1.5 mr-1 mb-4 text-xs text-red-500 hover:text-red-700">
                                        <flux:button icon="x-mark" variant="subtle" type="button" @click="remove(index)" x-show="sizes.length > 1"></flux:button>
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
                        <flux:button type="submit" variant="primary">Save Color</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>