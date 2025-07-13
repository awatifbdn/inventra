<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paint Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class=" bg-gradient-to-br from-purple-200 to-yellow-100 text-gray-800 min-h-screen flex flex-col">

    <!-- 🛍️ Navigation -->
    <header class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo and Branding -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/FE_Logo.png') }}" alt="Logo" class="h-10">
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="/" class="text-gray-600 hover:text-orange-500 font-medium">Home</a>
                <a href="/catalog" class="text-gray-600 hover:text-orange-500 font-medium">Catalog</a>
                <a href="/painting-tips" class="text-gray-600 hover:text-orange-500 font-medium">Tips</a>
            </nav>

            <!-- Cart Icon -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('order.cart.view') }}" class="relative ml-4 text-gray-600 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13l-1.5-6M7 13H5.4M16 16a1 1 0 100 2 1 1 0 000-2zm-8 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    @php $cart = session('cart', []); @endphp
                    @if(is_array($cart) && count($cart) > 0)
                        <span class="absolute -top-1.5 -right-2 text-[10px] bg-red-600 text-white rounded-full px-1">
                            {{ count($cart) }}
                        </span>
                    @endif
                </a>

                <!-- Mobile Menu Toggle (optional) -->
                <button class="md:hidden text-gray-600 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- 📦 Content -->
    <main class="flex-grow px-4">
        @yield('content')
    </main>

    <!-- 📄 Footer -->
    <footer class="bg-gray-200 text-center text-sm text-gray-600 py-4 mt-10">
        &copy; {{ date('Y') }} Fitrafham Paints. All rights reserved.
    </footer>

</body>
</html>
