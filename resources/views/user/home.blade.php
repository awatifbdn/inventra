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
    <div class="catalogue-container">
      <div class="catalogue-item">
        <img src="{{ asset('images/Ultrasheild.jpeg') }}" alt="ULTRASHEILD">
        <h3>ULTRASHEILD</h3>
        <p">an acrylic emulsion paint specially fomulated to provide additional protection for exterior walls.
      </br> </br>It acts as a durable coat and protect your walls from weather variation and fungus.
         </p>
          <a href="{{ route('colour') }}"class="button-details"> Buy Now</a>
    </div>
      <div class="catalogue-item">
        <img src="{{ asset('images/KalerSheild.jpeg') }}" alt="KALERSHEILD">
        <h3>KALERSHEILD</h3>
        <p>An economy acrylic emulsion paint designed to give an excellent protective for exterior walls with lower cost.
        </br></br>It is formulated for excellent weathering properties, fungus and alga resistance.
        </p>
          <a href="{{ route('kalersheild') }}"class="button-details"> Buy Now</a>
    </div>
      <div class="catalogue-item">
        <img src="{{ asset('images/SuperCoat.png') }}" alt="SUPERCOAT">
        <h3>SUPERCOAT</h3>
        <p>A top quality copolymer emulsion paint, specially formulated to give smooth and aesthetic finish for interior use.
        </br></br>It is easy to apply, washable, environmentally friendly, fragrance added, and fungus resistant. 
        </p>
          <a href="{{ route('supercoat') }}"class="button-details"> Buy Now</a>
      </div>
      <div class="catalogue-item">
        <img src="{{ asset('images/Maxicoat.png') }}" alt="MAXICOAT">
        <h3>MAXICOAT</h3>
        <p>Specially formulated water based copolymer emulsion coatings. 
          It has styrene acrylic resin content which provide a matte finish to almost kind of surfaces. 
          Smooth finish with low toxic and non-smell.</p>
        </p>
          <a href="{{ route('maxicoat') }}"class="button-details">Buy Now</a>
      </div>
      <div class="catalogue-item">
        <img src="{{ asset('images/MaxicoatLite.png') }}" alt="MAXICOAT LITE">
        <h3>MAXICOAT LITE</h3>
        <p>Specially formulated water based copolymer emulsion coatings. It has Vinyl Acetate Resin content which provide a matt finishing to almost kind of surface. 
          It has smooth finish with low smell and non toxic</p>
          <a href="{{ route('maxicoatlite') }}"class="button-details">Buy Now</a>
      </div>
      <div class="catalogue-item">
        <img src="{{ asset('images/Glomel.png') }}" alt="GLOMEL">
        <h3>GLOMEL</h3>
        <p>Premium grade alkyd enamel paint, specially formulated for exterior and interior metal and wood surfaces with excellent gloss appearance , 
          excellent durability even under taugh weather conditions and outstanding resistance to fungus and calking.</p>
          <a href="{{ route('glomel') }}" class="button-details">Buy Now</a>
      </div>
    </div>
  </section>
</body>
</html>
