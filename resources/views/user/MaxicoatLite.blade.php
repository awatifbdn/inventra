<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventra</title>
    <link rel="stylesheet" href="../CSS/colour.css">

</head>
<body>
  <!-- Header -->
  <header class="navbar">
    <img src="{{ asset('images/logo1.jpg') }}" class="logo" alt="Logo">
    <input type="text" class="search-bar" placeholder="Search Here...">
  </header>

  <!--Buy Now -->
  <div class="product-page">
    <div class="product-container">
      <div class="product-image">
        <img src="{{ asset('images/MaxicoatLite.png') }}" alt="Product Image">
      </div>
      <div class="product-details">
        <h1>MAXICOAT LITE</h1>
        <p>Specially formulated water based copolymer emulsion coatings. It has Vinyl Acetate Resin content which provide a matt finishing to almost kind of surface. 
          It has smooth finish with low smell and non toxic</p>

      <div class="product-price">
        <label for="size">Pack Size:</label>
        <select name="size" id="size" onchange="updatePrice()">
          <option value="5" data-price="120.50">1 liter</option>
          <option value="10" data-price="230.90">10 liter</option>
          <option value="15" data-price="349.90">15 liter</option>
        </select>
        <p><strong> Price: </strong><span id="price"> RM 120.50</span></p>
      </div>

      <div class="colour-selector">
        <label for="colour">Colour:</label>
        <div class="select-colour-btn" onclick="toggleDropdown()">
          <span id="select-colour-name">Select Colour</span>
      </div>

      <input type ="hidden" id="selected-colour" name="colour" value="">

      <div id="dropdown-options" class="colour-dropdown">
        <div class="colour-grid">
          <div class="colour-item" onclick="selectColour('Corn Silk', 
          '{{ asset('images/CornSilk.jpg')}}')">
            <img src="{{ asset('images/CornSilk.jpg') }}" alt="Corn Silk">
            <span>Corn Silk</span>
          </div>
          <div class="colour-item" onclick="selectColour('Ungu Muda', 
          '{{ asset('images/CornSilk.jpg')}}')">
            <img src="{{ asset('images/CornSilk.jpg') }}" alt="Corn Silk">
            <span>Ungu Muda</span>
        </div>
      </div>
    </div>
      <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"> 
      </div>

    <script>
      function updatePrice(){
        const sizeDropdown = document.getElementById('size');
        const selectedOption = sizeDropdown.options[sizeDropdown.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        //update the price span
        document.getElementById('price').textContent = 'RM' + price;
      }

      function updateColourImage() {
        const colourDropdown = document.getElementById('colour');
        const selectedOption = colourDropdown.options[colourDropdown.selectedIndex];
        const imageSrc = selectedOption.getAttribute('data-image');
        document.getElementById('colour-preview').src = imageSrc;
      }

      function toggleDropdown() {
        document.getElementById("dropdown-options").classList.toggle("show");
      }

      function selectColour(colourName, imageSrc) {
        document.getElementById("select-colour-name").innerText = colourName;;
        document.getElementById("selected-colour").value = colourName;
        document.getElementById("dropdown-options").classList.remove("show");
      }

        window.addEventListener('click', function(e) {
          if (!e.target.closest('.colour-selector')) {
            document.getElementById("dropdown-options").classList.remove('show');
          }
        });
      
    </script>
    </br>
    </br>
      <button type="submit" class="button-order">Order Now</button>
      <button type="back" class="button-back">Back</button>
      </div>
    </div>
  </section>
</body>
</html>

