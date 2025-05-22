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

  <!-- Details -->
  <form action="{{ route('details') }}" method="POST">
    @csrf
    <section class="details">
      <h2>CUSTOMER DETAILS</h2>
      <div class="details-grid">
        <div class="details-item">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </br>
        </br>
        </div>

        <div class="details-item">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required> 
        </br>
        </br>
        </div>

        <div class="details-item">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>
        </br>
        </br>        
        </div>
        <div class="details-button">
            <button type="submit">Order Now</button>
            <button type="back">Back</button>
  </section>
</body>
</html>