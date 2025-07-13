<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') }}">
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
      background: linear-gradient(to bottom right, rgba(253, 180, 251, 0.4),  rgba(253, 230, 138, 0.4));
    }

    .gradient-opacity2 {
      background: linear-gradient(to bottom right, rgba(253, 230, 138, 0.4), rgba(253, 180, 251, 0.4));
    }


    .table-row-even {
      background-color: rgba(255, 255, 255, 0.15);
      color: #674e30;
    }
    .table-row-odd {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .table-header {
      background-color: rgba(255, 255, 255, 0.25);
      font-weight: 600;
      color: #4b311b;
      
    }
    .table-cell {
      color: #4b311b;
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
      <img src="/images/binapaint_logo2.jpeg" alt="Inventra Logo" class="w-32 h-auto mx-auto mb-6 shadow-lg ring-8 ring-offset-2 ring-offset-white ring-white/40 rounded-full" />
      <h1 class="text-4xl font-bold mb-4 drop-shadow-lg">Creating Your Most Beautiful Home</h1>
      <p class="text-white/80 text-base leading-relaxed mb-6 drop-shadow-sm">Your trusted partner for efficient paint distribution. Explore vibrant colors, manage inventory with ease, and discover new finishes for your next project.</p>
      <div class="flex justify-center gap-4">
        <a href="{{ route('catalog.index') }}" class="px-5 py-1.5 text-white border border-white/40 hover:border-white hover:bg-white hover:text-black rounded transition">Browse Catalog</a>
      </div>
    </section>

    <!-- Company Info Section -->
    <section class="w-full max-w-6xl px-6 py-16 gradient-opacity backdrop-blur-sm rounded-xl shadow-md text-left">
      <h2 class="text-2xl font-semibold mb-6 text-center text-teal-100">Company Profile</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="text-sm">
          <div class="grid grid-cols-2 border border-white/30 bg-white/70 rounded-lg overflow-hidden">
            <div class="table-header px-4 py-3 font-bold">Company Name</div>
            <div class="table-row-even px-4 py-3 table-cell">FITRAFHAM INTEGRATED SDN. BHD.</div>
            <div class="table-header px-4 py-3 font-bold">Company Registration No.</div>
            <div class="table-row-odd px-4 py-3 table-cell">1005267D / 201201020775</div>
            <div class="table-header px-4 py-3 font-bold">Nature of Business</div>
            <div class="table-row-even px-4 py-3 table-cell">CONSTRUCTION. BUSINESS CONSULTANTS. GENERAL TRADING.</div>
            <div class="table-header px-4 py-3 font-bold">Date of Registration</div>
            <div class="table-row-odd px-4 py-3 table-cell">2012-06-08</div>
            <div class="table-header px-4 py-3 font-bold">State</div>
            <div class="table-row-even px-4 py-3 table-cell">PERAK</div>
          </div>
        </div>
        <div class="text-sm leading-relaxed space-y-4">
          <h3 class="text-lg font-semibold text-teal-100">Company Description</h3>
          <p>FITRAFHAM INTEGRATED SDN. BHD. was incorporated on 2012-06-08 in Malaysia with registration number of <strong>1005267D / 201201020775</strong>. The business includes <strong>CONSTRUCTION</strong>, <strong>BUSINESS CONSULTANTS</strong>, and <strong>GENERAL TRADING</strong>.</p>
          <p>Get an accurate picture of a customer's financial status with a credit report for a business. Our solutions help you minimise risk, increase sales and improve business performance.</p>
        </div>
      </div>
    </section>

<!-- Vision & Mission Section -->
    <section class="w-full max-w-6xl px-6 py-16 mt-8 gradient-opacity2 backdrop-blur-sm rounded-xl shadow-md text-center text-white">
      <div class="space-y-6">
        <div>
          <h3 class="text-xl font-semibold text-teal-100 mb-2">Vision</h3>
          <p class="leading-relaxed">To become an inspiring and growing company in various sectors and fields by 2030.</p>
        </div>
        <br>
        <div>
          <h3 class="text-xl font-semibold text-teal-100 mb-2">Mission</h3>
          <p class="leading-relaxed">To be a trusted contractor, supplier, trader, and organizer of training centers that is professional and reputable in enhancing the company's competitiveness by providing the best materials and services to customers. FISB is ready to help and develop other companies through technical support or business opportunities.</p>
        </div>
        <br>
        <div>
          <h3 class="text-xl font-semibold text-teal-100 mb-2">Objectives</h3>
          <ul class="list-disc list-inside space-y-2">
            <li>Become a contractor and supplier company that meets customer needs and satisfaction.</li>
            <li>Provide the best services to customers to achieve the company's vision and mission.</li>
            <li>Committed to delivering high-quality services in compliance with set standards.</li>
            <li>Be a reputable company and open up opportunities to the public.</li>
            <li>Provide training services that are affordable, systematic, and customer-friendly.</li>
            <li>Develop network infrastructure for efficient and successful services.</li>
          </ul>
        </div>
      </div>
    </section>
      
    <!-- Contact Information Section with Map and Form -->
    <section class="w-full max-w-6xl px-6 py-16 mt-8 bg-white/30 backdrop-blur-sm rounded-xl shadow-md text-left text-white">
      <h2 class="text-3xl font-bold mb-10 text-center text-teal-100">Contact Us</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Contact Details -->
        <div class="space-y-4">
          <p class="text-lg"><strong>Address:</strong> No. 123, Jalan Example, 30000 Ipoh, Perak, Malaysia</p>
          <p class="text-lg"><strong>Phone:</strong> +60 12-345 6789</p>
          <p class="text-lg"><strong>Email:</strong> info@fitrafham.com</p>
          <p class="text-lg"><strong>Website:</strong> www.fitrafham.com</p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31870.637158225084!2d101.0821284!3d4.5974791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31caec07af7d13b5%3A0x7e02f4a978fa1fef!2sIpoh%2C%20Perak%2C%20Malaysia!5e0!3m2!1sen!2smy!4v1620000000000!5m2!1sen!2smy" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- Contact Form -->
        <form class="space-y-4">
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Name</label>
            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Your Name">
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="you@example.com">
          </div>
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Message</label>
            <textarea class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" rows="4" placeholder="Your message"></textarea>
          </div>
          <button type="submit" class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow">Send Message</button>
        </form>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs text-white/70 mt-24">
      &copy; {{ date('Y') }} Fitrafham Integrated Sdn. Bhd. All rights reserved.
    </footer>
  </main>
</body>
</html>
