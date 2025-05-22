<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventra</title>
  <link rel="stylesheet" href="../CSS/homepage.css">
</head>
<body>
  <!-- Header -->
  <header class="navbar">
    <img src="{{ asset('images/logo1.jpg') }}" class="logo" alt="Logo">
    <input type="text" class="search-bar" placeholder="Search Here...">
  </header>

  <!-- Banner -->
  <section class="carousel">
    <button class="carousel-btn left">❮</button>
    <img src="{{ asset('images/banner3.jpg') }}" class="carousel-img" alt="Banner">
    <button class="carousel-btn right">❯</button>
  </section>

  <!-- Catalogue -->
  <section class="catalogue">
    <h2>CATALOGUE</h2>
    <div class="catalogue-grid">
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="../image/Ultrasheild.jpg" alt=""><p>ULTRASHEILD</p></div>
        </a>
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="https://via.placeholder.com/80x100" alt=""><p>KALERSHEILD</p></div>
        </a>
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="https://via.placeholder.com/80x100" alt=""><p>VINYLSHEEN</p></div>
        </a>
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="https://via.placeholder.com/80x100" alt=""><p>SUPERCOAT</p></div>
        </a>
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="https://via.placeholder.com/80x100" alt=""><p>MAXICOAT</p></div>
        </a>
        <a href="{{ route('colour') }}">
      <div class="catalogue-item"><img src="https://via.placeholder.com/80x100" alt=""><p>MAXICOAT LITE</p></div>
        </a>
    </div>
  </section>
</body>
</html>
