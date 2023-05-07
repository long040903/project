<?php 
require_once 'header.php';

require_once "connect.php";
require_once "Cart/cart.php";
require_once "Cart/addcart.php";

 
$images_folder = "ADMIN/uploads/";

// Assuming you have already established a database connection
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

// Loop through the products and generate HTML
while ($row = mysqli_fetch_assoc($result)) {
    $productId = $row['id'];
    $productName = $row['name'];
    $image_path = $row['img'];
    $productQuantity = $row['quantity'];
    $productPrice = $row['price'];

    echo '<div class="product-item">';
    echo '<h3>' . $productName . '</h3>';
    echo '<img src="' . $image_path . '" alt="' . $productName . '" />';
    echo '<p>Quantity: ' . $productQuantity . '</p>';
    echo '<p>Price: ' . $productPrice . '</p>';
    echo '<button onclick="openPopup(' . $productId . ')">View</button>';
    echo '</div>';
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>product</title>
    <style>
.popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.popup-content {
  background-color: #fff;
  width: 300px;
  margin: 100px auto;
  padding: 20px;
  text-align: center;
}

.popup-content h2 {
  margin-top: 0;
}

.popup-content button {
  margin-top: 10px;
}

</style>
<body>
<div id="popup" class="popup">
  <div class="popup-content">
    <h3 id="popup-title">
      <?php
      echo   $row["name"]; 
      ?>
    </h3>
    <img id="popup-image" src="" alt="" />
    <?php 
    echo "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents($image_path)) . "' alt='Hình ảnh sản phẩm'>";
    ?>
    <p id="popup-price">
      <?php echo $row["price"];?>
    </p>
    <button onclick="closePopup()">Close</button>
  </div>
</div>
<script>
    function openPopup(productId) {
  // Fetch product details using AJAX or update the content directly with PHP

  // Example of updating the content with JavaScript
  var productName = 'Product Name'; // Replace with actual product name
  var productImg = 'path/to/image.jpg'; // Replace with actual product image path
  
  var productPrice = 9.99; // Replace with actual product price

  var popup = document.getElementById('popup');
  var popupTitle = document.getElementById('popup-title');
  var popupImage = document.getElementById('popup-image');
  var popupPrice = document.getElementById('popup-price');

  popupTitle.textContent = productName;
  popupImage.src = productImg;
  popupImage.alt = productName;
  popupPrice.textContent = 'Price: ' + productPrice;

  popup.style.display = 'block';
}

function closePopup() {
  var popup = document.getElementById('popup');
  popup.style.display = 'none';
}

    </script>
</body>