@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    

       <!-- 📸 Hero Carousel -->
       <!-- 🎨 Auto-Sliding Image Carousel -->
        <div 
            x-data="{
                activeSlide: 0,
                slides: [
                    '{{ asset("images/banner1.png") }}',
                    '{{ asset("images/banner2.png") }}',
                    '{{ asset("images/banner3.png") }}'
                ],
                init() {
                    setInterval(() => {
                        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                    }, 5000); // change every 5 seconds
                }
            }"
            class="relative w-full h-64 mb-8 overflow-hidden rounded-lg shadow-lg"
        >

            <!-- 📸 Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" x-transition
                    class="absolute inset-0">
                    <img :src="slide" alt="Paint Promotion" class="w-full h-full object-cover">
                </div>
            </template>

            <!-- ◀️ Prev / ▶️ Next Arrows -->
            <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/70 p-2 rounded-full shadow hover:bg-white">
                ◀
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/70 p-2 rounded-full shadow hover:bg-white">
                ▶
            </button>

            <!-- 🔘 Dots -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index"
                            :class="{ 'bg-blue-500': activeSlide === index, 'bg-white': activeSlide !== index }"
                            class="w-3 h-3 rounded-full border border-blue-500"></button>
                </template>
            </div>
        </div>


    <!-- 🔍 Search & Filter -->
    <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
        <input name="search" type="text" placeholder="Search product..." value="{{ request('search') }}"
               class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">

        <select name="category" class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
            <i class="fas fa-search"></i> 
        </button>
    </form>


    <!-- 🖼️ Product Grid -->
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($products as $product)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-4">
            @php
                $images = json_decode($product->image_url, true);
            @endphp
              @foreach($images as $image)
              <div class="overflow-hidden rounded-sm  border-gray-200 items-center justify-items-center mb-4">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->productName }}" class="h-50 object-cover" style="width: 200px;"/>
                </div>
                @endforeach
                <h2 class="text-xl font-semibold text-blue-500">{{ $product->productName }}</h2>
                <p class="text-sm text-gray-500">{{ $product->category }}</p>
                <p class="text-sm mt-1 text-gray-700">{{ Str::limit($product->description, 200) }}</p>
                <p class="mt-1 text-sm text-gray-600">Price: RM{{ $product->min_price }} - RM{{ $product->max_price }}</p>

                <!-- 🎨 Color Swatches -->
                <div class="mt-3 flex gap-1 flex-wrap">
                    @foreach ($product->colors->take(5) as $color)
                     @if($color->color_pallet)
                        <span class="w-5 h-5 rounded-full border" title="{{ $color->color_name }}"
                              style="background-image: url('{{ asset('storage/' . $color->color_pallet) }}'); background-size: cover;"></span>
                        @endif
                    @endforeach
                    @if($product->colors->count() > 5)
                        <span class="text-xs text-gray-400 ml-1">+{{ $product->colors->count() - 5 }}</span>
                    @endif
                </div>

                <!-- 🔗 Button -->
                <a href="{{ route('catalog.show', $product->id) }}"
                   class="block mt-4 text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-400 transition">
                    View Colors
                </a>
            </div>
        @empty
            <p class="text-gray-500">No products found.</p>
        @endforelse
    </div>
</div>
@endsection
