<x-layouts.app :title="'Manage Colors - ' . $product->productName">
    <div class="p-8 space-y-8">

        
            {{-- Product Image --}}
            <div class="flex w-full items-center gap-6 rounded-xl bg-white border border-gray-200 shadow-sm p-6">
                @php
                    $images = json_decode($product->image_url, true);
                @endphp
                @foreach($images as $image)
                    <div class="overflow-hidden rounded-sm border-gray-200">
                        <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="h-50 object-cover" style="width: 200px;" />
                    </div>
                @endforeach

                {{-- Product Info --}}
                <div class="flex-1 md:text-left space-y-1">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $product->productName }}</h2>
                    <p class="text-sm text-gray-600">{{ $product->category }}</p>
                    <p class="text-sm text-gray-600">Size: {{ $product->sizes }}</p>
                    <p class="text-sm text-gray-600">
                        Price:
                        <span class="font-medium text-blue-600">
                            RM{{ $product->min_price }} - RM{{ $product->max_price }}
                        </span>
                    </p>

                    {{-- Add Color Button --}}
                    <div class="mt-4 md:mt-0">
                        <flux:modal.trigger name="add-color">
                            <flux:button variant="primary" icon="plus">Add Color</flux:button>
                        </flux:modal.trigger>
                    </div>
                </div>
            </div>
        
            {{-- Add Color Modal --}}
            @include('colors.add_color', ['product' => $product])

       

        <!-- Main Content Grid -->
        <div class="space-y-6">
            <div class="flex justify-between items-center mt-6">
                <h3 class="text-xl font-semibold text-gray-700">Available Colors</h3>
            </div>

            <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 bg-white">
                <table class="min-w-full w-full divide-y divide-gray-200 text-sm text-center">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox"
                                    x-model="selectAll"
                                    @change="toggleAll"
                                    :indeterminate="isIndeterminate()"
                                    x-init="updateMasterCheckbox($el)">
                            </th>
                            <th class="px-4 py-3 text-left">Color</th>
                            <th class="px-4 py-3 text-left">Code</th>
                            <th class="px-4 py-3 text-left">Preview</th>
                            <th class="px-4 py-3 text-left">Litres</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                        <tr>
                            {{-- Bulk Actions Bar --}}
                            <x-color.bulk-action-bar
                                :product-id="$product->id"
                                :color-ids="$product->colors->pluck('id')->toArray()"
                            />
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($colors as $color)
                        <tr>
                            <td>
                                <div class="items-center justify-center">
                                    <input type="checkbox"
                                        value="{{ $color->id }}"
                                        x-model="selected"
                                        @change="checkSelectAll">
                                </div>
                            </td>

                            {{-- Color Name --}}
                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $color->color_name }}
                            </td>

                            {{-- Color Code --}}
                            <td class="px-4 py-3 text-gray-700">
                                {{ $color->color_code }}
                            </td>

                            {{-- Preview Box --}}
                            <td class="px-4 py-3 flex justify-center items-center">
                                <div class="h-10 rounded-full border border-gray-300"
                                    style="width: 300px; background-image: url('{{ asset('storage/' . $color->color_pallet) }}'); background-size: cover;">
                                </div>
                            </td>

                            {{-- Litres & Prices --}}
                            <td class="px-4 py-3 text-gray-700">
                                <div class="space-y-1">
                                    @foreach($color->litres as $litre)
                                    <div>{{ $litre->litre }} L</div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                <div class="space-y-1">
                                    @foreach($color->litres as $litre)
                                    <div class="font-semibold">RM{{ number_format($litre->price, 2) }}</div>
                                    @endforeach
                                </div>
                            </td>

                    <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                 {{-- Edit Button Trigger --}}
                                <flux:modal.trigger name="edit-color-{{ $color->id }}">
                                    <flux:button 
                                        icon="pencil" 
                                        variant="ghost" 
                                        size="xs" 
                                        square 
                                        tooltip="Edit" 
                                    />
                                </flux:modal.trigger>
                            

                             <form action="{{ route('colors.destroy', ['product' => $product->id, 'color' => $color->id]) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this color?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button 
                                        type="submit" 
                                        icon="trash" 
                                        variant="danger" 
                                        size="xs" 
                                        square 
                                        tooltip="Delete" />
                                </form>



                            </div>
                        </td>
                            @include('colors.edit_color', ['color' => $color])
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-sm mt-2">Selected: <span x-text="JSON.stringify(selected)"></span></p>
            </div>
        </div>
    </div>

    <script>
        function priceManager(allIds, deleteUrl, adjustPriceUrl) {
            return {
                all: allIds,
                selected: [],
                selectAll: false,
                deleteUrl,
                adjustPriceUrl,
                toggleAll() {
                    if (this.selectAll) {
                        this.selected = [...this.all];
                    } else {
                        this.selected = [];
                    }
                },
                checkSelectAll() {
                    this.selectAll = this.all.every(id => this.selected.includes(id.toString()));
                },
                isIndeterminate() {
                    return this.selected.length > 0 && this.selected.length < this.all.length;
                },
                updateMasterCheckbox(el) {
                    el.indeterminate = this.isIndeterminate();
                },
                openAdjustModal() {
                    this.$refs.adjustModal.showModal();
                }
            };
        }
    </script>
</x-layouts.app>
