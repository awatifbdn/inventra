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
    <img src="https://via.placeholder.com/120x40?text=INVENTRA" class="logo" alt="Logo">
    <input type="text" class="search-bar" placeholder="Search Here...">
  </header>

  <!-- Details -->
  <form action="{{ route('details') }}" method="POST">
    @csrf
    <section class="details">
      <h2>PRODUCT DETAILS</h2>
      <div class="details-grid">
        <div class="details-item">
          <img src="../image/Ultrasheild.jpg" alt="">
          <p>ULTRASHEILD</p>
          <p>Price: $50</p>
          <p>Description: A high-quality paint for all surfaces.</p>
        </div>
        <div class="details-item">
          <img src="../image/Kalerschield.jpg" alt="">
          <p>KALERSHEILD</p>
          <p>Price: $45</p>
          <p>Description: Durable and long-lasting paint.</p>
        </div>
      </div>
    </section>
  </section>
</body>
</html>