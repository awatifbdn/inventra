
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventra</title>
    <link rel="stylesheet" href="../CSS/details.css">

</head>
<body>
  <!-- Header -->
  <header class="navbar">
    <img src="{{ asset('images/logo1.jpg') }}" class="logo" alt="Logo">
  </header>

<div class="checkout-container">
    <div class="left-section">
        <h1>CHECKOUT</h1>

        <label for="name">Name <span class="required">*</span></label>
        <input type="text" id="name" required>
        <label for="email">Email Address <span class="required">*</span></label>
        <input type="email" id="email" required>
        <label for="phone">Phone Number <span class="required">*</span></label>
        <input type="tel" id="phone" required>

            <!-- Add buttons here -->
    <div class="button-group">
        <button type="submit" class="button-order">Order Now</button>
    </div>


    </div>

    <div class="right-section">
        <div class="order-summary">
            <h2>YOUR ORDER SUMMARY</h2>
            <div class="product-item">
                <img src="{{ asset('images/virusguard.png') }}" alt="VirusGuard Paint">
                <div class="product-info">
                    <strong>VirusGuard</strong>
                    <p>Quantity: 1</p>
                </div>
                <div class="price">
                    RM 69.50
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>