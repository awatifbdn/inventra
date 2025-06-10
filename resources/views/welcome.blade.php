<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventra | Paint Distribution System</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' };
  </script>

  <style>
    .bg-overlay::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
      z-index: 0;
    }

    .color-dot {
      animation: float 3s ease-in-out infinite;
      transform-origin: center;
    }

    @keyframes float {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-10px) scale(1.05); }
      100% { transform: translateY(0) scale(1); }
    }
  </style>
</head>

<body class="relative text-white bg-black overflow-x-hidden">

  <!-- Background Image + Blur -->
  <div class="fixed inset-0 z-[-2]">
    <img src="/images/bg2.jpg" alt="Background" class="w-full h-full object-cover" />
  </div>
  <div class="bg-overlay fixed inset-0 z-[-1]"></div>

  <!-- Floating Color Dots -->
  <div class="fixed bottom-20 left-1/2 -translate-x-1/2 flex gap-4 z-10">
    @foreach (['#F53003', '#FFD700', '#3CB371', '#4682B4', '#8A2BE2', '#FF69B4'] as $index => $color)
      <div class="w-10 h-10 rounded-full shadow-lg color-dot"
           style="background-color: {{ $color }}; animation-delay: {{ $index * 0.3 }}s;"></div>
    @endforeach
  </div>

  <!-- Navigation -->
  <header class="absolute top-6 right-6 text-sm z-10">
    @if (Route::has('login'))
      <nav class="flex gap-3">
        @auth
          <a href="{{ url('/dashboard') }}" class="px-5 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded transition shadow">
            Dashboard
          </a>
        @else
          <a href="{{ route('login') }}" class="px-5 py-1.5 border rounded border-white hover:bg-white hover:text-black transition">
            Log in
          </a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-5 py-1.5 border rounded border-white hover:bg-white hover:text-black transition">
              Admin Registration
            </a>
          @endif
        @endauth
      </nav>
    @endif
  </header>

  <!-- Scrollable Content -->
  <main class="relative z-10 w-full flex flex-col items-center px-4 sm:px-6 lg:px-8">

    <!-- Hero Section -->
    <section class="text-center py-32 max-w-2xl w-full">
      <img src="/images/logo.png" alt="Inventra Logo" class="w-24 h-24 mx-auto mb-6 rounded-full shadow-lg ring-4 ring-white/30" />
      <h1 class="text-4xl font-bold mb-4 drop-shadow-lg">Welcome</h1>
      <p class="text-white/80 text-base leading-relaxed mb-6 drop-shadow-sm">
        Your trusted partner for efficient paint distribution. Explore vibrant colors, manage inventory with ease, and discover new finishes for your next project.
      </p>
      <div class="flex justify-center gap-4">
        <a href="#" class="px-6 py-2 bg-[#F53003] hover:bg-[#c82302] text-white rounded-lg shadow transition">
          Browse Catalog
        </a>
      </div>
    </section>

    <!-- Company Info Section -->
    <section class="w-full max-w-6xl px-6 py-16 bg-white/10 backdrop-blur-md rounded-xl shadow-md text-left text-white">
      <h2 class="text-2xl font-semibold mb-6 text-center text-teal-300">Company Profile</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Table -->
        <div class="text-sm">
          <div class="grid grid-cols-2 border border-white/20">
            <div class="bg-teal-900 px-4 py-3 font-bold">Company Name</div>
            <div class="bg-teal-800 px-4 py-3">FITRAFHAM INTEGRATED SDN. BHD.</div>
            <div class="bg-teal-900 px-4 py-3 font-bold">Company Registration No.</div>
            <div class="bg-teal-800 px-4 py-3">1005267D / 201201020775</div>
            <div class="bg-teal-900 px-4 py-3 font-bold">Nature of Business</div>
            <div class="bg-teal-800 px-4 py-3">CONSTRUCTION. BUSINESS CONSULTANTS. GENERAL TRADING.</div>
            <div class="bg-teal-900 px-4 py-3 font-bold">Date of Registration</div>
            <div class="bg-teal-800 px-4 py-3">2012-06-08</div>
            <div class="bg-teal-900 px-4 py-3 font-bold">State</div>
            <div class="bg-teal-800 px-4 py-3">PERAK</div>
          </div>
        </div>
        <!-- Description -->
        <div class="text-sm leading-relaxed space-y-4">
          <h3 class="text-lg font-semibold text-teal-300">Company Description</h3>
          <p>
            FITRAFHAM INTEGRATED SDN. BHD. was incorporated on 2012-06-08 in Malaysia with registration number of
            <strong>1005267D / 201201020775</strong>. The business includes <strong>CONSTRUCTION</strong>,
            <strong>BUSINESS CONSULTANTS</strong>, and <strong>GENERAL TRADING</strong>.
          </p>
          <p>
            Get an accurate picture of a customer's financial status with a credit report for a business.
            Our solutions help you minimise risk, increase sales and improve business performance.
          </p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs text-white/70 mt-24">
      &copy; {{ date('Y') }} Fitrafham Integrated Sdn. Bhd. All rights reserved.
    </footer>
  </main>
</body>
</html>
