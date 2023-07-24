<?php
require_once 'header.php';
session_start();
require_once "connect.php";
$images_folder = "ADMIN/uploads/";
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

if (!isset($_SESSION['login'])) {
    header('Location: ../Login/login2.php');
    exit();
}

$product_id = $_GET["prd_id"];
$user = $_SESSION['login'];

// Product queries with corresponding IDs
$sql = "SELECT * FROM product WHERE id = " . $product_id;
$result = mysqli_query($conn, $sql);

// Check if the product exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $image_path = $images_folder . $row['img'];
} else {
    echo "Product not found";
    exit();
}

// Processing when the user presses the "Add to Cart" button
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Add products to cart
    

    // Redirect users to a cart page
    header("Location: ../Cart/cart.php");
    exit();
}

// Processing when users submit feedback
if (isset($_POST['feedback'])) {
    $message = $_POST['message'];

    // Perform a save of the response to the database
    $insert_feedback_query = "INSERT INTO feedback (userId, content, rating, productId) VALUES ('$user', '$message', '5', '$product_id')";
    $insert_feedback_result = mysqli_query($conn, $insert_feedback_query);

    if ($insert_feedback_result) {
        echo "<p class='success-message'>Submit feedback successfully</p>";
    } else {
        echo "<p class='error-message'>Submit failed response</p>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product details</title>
    <style>
     

           
</style>
</head>

<body>
  
  <div class="product-container">
  
    <div class="product-image">
      <a href="products.php"><i class="fas fa-arrow-left"></i></a>
      <?php
      if (file_exists($image_path)) {
          echo "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents($image_path)) . "' alt='Product Images'>";
      } else {
          echo "<p>Product photo not found</p>";
      }
      ?>
    </div>
    <div class="product-details">
      <span class="spanroduct-name"><?php echo $row["name"]; ?></span>
      <p class="product-price"><?php echo "price: " . $row["price"]; ?></p>
      
      <div class="add-to-cart-section">
        <div class="quantity-form">
          <form action="../Source/Cart/cart.php" method="post">
          <label for="quantity" style="font-size:1.5rem;">quantity:</label>
          <input type="hidden" name="product_id" value="<?php echo  $row["id"] ?>" >
          <input type="text" name="quantity" id="quantity" value="1" min="1" class="quantity-input">
          <button type="submit" name="add_to_cart" >add cart</button>
          </form>
        </div>
        
      </div>
      <form class="feedback-form" method="POST">
    <textarea id="feedback" name="message" rows="6" cols="100" placeholder="message"></textarea><br>
    <button type="submit" name="feedback">Send feedback</button>
  </form>
    </div>
  </div>


</body>

</html>



<?php require_once 'footer.php';?>