<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventra</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'false' };
  </script>

  <style>
    .bg-overlay::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }
     .gradient-opacity {
      background: linear-gradient(to bottom right, rgba(253, 180, 251, 0.541), rgba(253, 230, 138, 0.503));
    }
  </style>
</head>

<body class="relative text-white overflow-x-hidden">
  <!-- Background Image -->
  <div class="fixed inset-0 z-[-2]">
    <img src="/images/bg3.png" alt="Background" class="w-full h-full object-cover" />
  </div>
  <div class="bg-overlay fixed inset-0 z-[-1]"></div>

  <!-- Navigation -->
  <header class="w-full px-6 max-w-7xl mx-auto mt-6 z-10">
    @if (Route::has('login'))
      <nav class="flex items-center justify-end gap-4 text-sm">
        @auth
          <a href="{{ url('/dashboard') }}" class="px-5 py-1.5 text-white bg-green-600 hover:bg-green-700 rounded shadow transition">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="px-5 py-1.5 text-white border border-white/40 hover:border-white hover:bg-white hover:text-black rounded transition">Log in</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-5 py-1.5 text-white border border-white/40 hover:border-white hover:bg-white hover:text-black rounded transition">Register</a>
          @endif
        @endauth
      </nav>
    @endif
  </header>

  @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
  @endif

  <!-- Hero Section -->
  <main class="relative z-10 w-full flex flex-col items-center px-4 sm:px-6 lg:px-8">
    <section class="text-center py-32 max-w-2xl w-full">
      <img src="/images/logo.png" alt="Inventra Logo" class="w-24 h-24 mx-auto mb-6 rounded-full shadow-lg ring-4 ring-white/30" />
      <h1 class="text-4xl font-bold mb-4 drop-shadow-lg">Creating Your Most Beautiful Home</h1>
      <p class="text-white/80 text-base leading-relaxed mb-6 drop-shadow-sm">Your trusted partner for efficient paint distribution. Explore vibrant colors, manage inventory with ease, and discover new finishes for your next project.</p>
      <div class="flex justify-center gap-4">
        <a href="{{ route('catalog.index') }}" class="px-5 py-1.5 text-white border border-white/40 hover:border-white hover:bg-white hover:text-black rounded transition">Explore Colour Cards</a>
      </div>
    </section>

    <!-- Company Info Section -->
    <section class="w-full max-w-6xl px-6 py-16 gradient-opacity rounded-xl shadow-md text-left text-white">
      <h2 class="text-2xl font-semibold mb-6 text-center text-teal-300">Company Profile</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
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
        <div class="text-sm leading-relaxed space-y-4">
          <h3 class="text-lg font-semibold text-teal-300">Company Description</h3>
          <p>FITRAFHAM INTEGRATED SDN. BHD. was incorporated on 2012-06-08 in Malaysia with registration number of <strong>1005267D / 201201020775</strong>. The business includes <strong>CONSTRUCTION</strong>, <strong>BUSINESS CONSULTANTS</strong>, and <strong>GENERAL TRADING</strong>.</p>
          <p>Get an accurate picture of a customer's financial status with a credit report for a business. Our solutions help you minimise risk, increase sales and improve business performance.</p>
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
