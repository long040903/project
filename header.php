<?php
session_start();
require_once "connect.php";

require_once 'ADMIN/utils.php';
error_reporting(0);

$images_folder = "ADMIN/uploads/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font icofont cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="home.css?ver">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>


</head>
<body>
    
<!-- header section starts -->

    <header class="header">

        <a href="home.php" class="logo"><i class="icofont-juice"></i> juice </a>

        <nav class="navbar">
            <a href="home.php">home</a>
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="products.php">products</a>
                <a href="about.php">about</a>
                <a href="review.php">review</a>
                <a href="blog.php">blogs</a>
                <a href="contact.php">contact</a>
            <?php } ?>
        </nav>


        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="cart-btn" class="fas fa-shopping-cart"></div>
            <div class="fas fa-circle-user" id="caret-down">

            <div class="shopping-cart">
                <div class="box">
                
                      <?php
                            session_start();
                            require_once "connect.php";
                            $customer_id = $_SESSION['login'];

                            if (!isset($_SESSION['cart'])) {
                              $_SESSION['cart'] = array();
                            }

                            // Check if the user has clicked the "Add to Cart" button
                            if (isset($_POST['add_to_cart'])) {
                              // Get product information from the form
                              $product_id = $_POST['product_id'];

                              $quantity = $_POST['quantity'];
                              // Check if the product is already in the cart
                              if (isset($_SESSION['cart'][$product_id])) {

                                // If available, add the number
                                $_SESSION['cart'][$product_id] += $quantity;
                              } else {
                                // If you don't already have one, add a new product to your cart
                                $_SESSION['cart'][$product_id] = $quantity;
                              }
                            }

                            // Check if the user has pressed the "Update cart" button
                            if (isset($_POST['update_cart'])) {
                              foreach ($_POST['quantity'] as $product_id => $quantity) {
                                // Check and update the number of products in the cart
                                if ($quantity > 0) {
                                  $_SESSION['cart'][$product_id] = $quantity;
                                } else {
                                  unset($_SESSION['cart'][$product_id]);
                                }
                              }
                            }

                            // Check if the user has pressed the "Remove product" button
                            if (isset($_GET['remove'])) {
                              $product_id = $_GET['remove'];

                              // Remove products from cart
                              unset($_SESSION['cart'][$product_id]);
                            }

                            // Check if the user has pressed the "Edit product" button
                            if (isset($_POST['update_product'])) {
                              $product_id = $_POST['update_product'];
                              $new_quantity = $_POST['quantity'][$product_id];

                              // Check and update the number of products in the cart
                              if ($new_quantity > 0) {
                                $_SESSION['cart'][$product_id] = $new_quantity;
                              } else {
                                unset($_SESSION['cart'][$product_id]);
                              }
                            }

                            // Check if the user has pressed the "Confirm payment" button
                            if (isset($_POST['checkout'])) {
                              $total_price = 0;
                              $order_details = array();
                              $total_quantity = 0;
                              foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $sql = "SELECT * FROM product WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $price = $row['price'];
                                $subtotal = $price * $quantity;
                                $total_price += $subtotal;


                                $total_quantity +=  $quantity;

                                $order_details[] = array(
                                  'product_id' => $product_id,
                                  'quantity' => $quantity,
                                  'price' => $price,
                                  'subtotal' => $subtotal
                                );
                              }

                              


                              $status = 'Pending';
                              $sql = "INSERT INTO `order` (`userId`,  `totalPrice`, `quantity`, `status`) VALUES ('$customer_id','$total_price','$total_quantity', '$status')";
                              mysqli_query($conn, $sql);

                              $order_id = mysqli_insert_id($conn);

                              foreach ($order_details as $order_detail) {
                                $product_id = $order_detail['product_id'];
                                $quantity = $order_detail['quantity'];
                                $price = $order_detail['price'];
                                $subtotal = $order_detail['subtotal'];
                                $sql = "INSERT INTO orderdetail (orderId, productId, quantity, totalPrice) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                                mysqli_query($conn, $sql);
                              
                              }

                             
                            }
                            ?>


                                
                                    <?php
                                    $total_price = 0;
                                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                    $sql = "SELECT * FROM product WHERE id = $product_id";
                                
                                      $result = mysqli_query($conn, $sql);
                                      $row = mysqli_fetch_assoc($result);
                                      $subtotal = $row['price'] * $quantity;
                                      $total_price += $subtotal;

                                      echo '<a href="order.php?remove=' . $product_id . '" class="fas fa-times"></a>';
                                      echo "<img src='ADMIN/uploads/" . $row['img'] . "' alt='Product Image'>";
                                      echo '<div class="content">';
                                      echo '<form method="post" action="cart.php">';
                                      echo '<h3>' . $row['name'] . '</h3>';
                                      echo '<span class="quantity">' . $quantity . '</span>';
                                      echo '<span class="multiply">x</span>';
                                      echo '<span class="price">' . $row['price'] . '</span>';
                                      echo '</form>';
                                      echo '</div>';
                                      
                                    }
                                    ?>
                                    </div>
                                
                                      <h3 class="total">Total: <span><?php echo $total_price; ?></span></h3>
                                <script>
                              // Function to calculate total amount
                              function calculateTotal() {
                                // Get all checkboxes selected
                              
                                var total = 0;

                                // Loop through each checkbox and calculate the total amount
                                checkboxes.forEach(function (checkbox) {
                                  var row = checkbox.parentNode.parentNode;
                                  var quantity = parseInt(row.querySelector('input[name^="quantity"]').value);
                                  var price = parseFloat(row.querySelector('td:nth-child(5)').textContent);
                                  var subtotal = quantity * price;
                                  total += subtotal;
                                });

                                // Show total amount
                                var totalElement = document.querySelector('tfoot td:nth-child(2)');
                                totalElement.textContent = total;
                              }

                            
                            </script>
            </div>

                <div class="caret_down">
                
                
                    
                        <?php
                        echo '<div class="box">';
                        if (   isset($_POST['showuser']  ) ) {
                            
                            $username = $_POST['username'];
                            $password = sha1 ($_POST['password']);
                            $email = $_POST['email'];
                            $phoneNumber = $_POST['phone_number'];
                            $_SESSION['username'] = $_POST['username'];
                            $_SESSION['email'] = $_POST['email']; // Save the username to the global variable
                            header('Location: home.php'); // Redirect to the Home page
                            // dd($showuser);
                            exit();
                          }
                          echo '<div class="content">';
                        if (isset($_SESSION['username'])) {
                            echo '<h3>Welcome to our shop </h3>';
                            
                            echo '<span>';
                            echo 'Name: ' . $_SESSION['username'];
                            echo '</span><br>';
                            if (isset($_SESSION['email'])) {
                                echo '<span>';
                                echo 'Email: '. $_SESSION['email'];
                                echo '</span>';
                            }
                            echo '<button id="logout-btn" class="btn">logout</button>';
                        } else {
                            echo '<i class="fas fa-hand-point-down"></i><a href="login.php" class="btn">login now</a>'; // Display user icon if not logged in
                            
                        }
                        echo '</div>';
                        echo '</div>';
                                    
                                
                           ?>

                </div>
            </div>
        </div>

                    
                    <div id="confirm-box">
                        <h3>Are you sure you want to logout?</h3>
                        <button id="confirm-yes">Yes</button>
                        <button id="confirm-no">No</button>
                    </div>
                    <div id="logout-success" class="hidden">
                        <h3>Logout successfully. Redirecting to home page...</h3>
                    </div>


                    
                    <script>
                          // JavaScript code
                        const caretDown = document.getElementById("caret-down");
                        const caretDownMenu = document.querySelector(".caret_down");

                        caretDown.addEventListener("click", function () {
                        caretDownMenu.classList.toggle("show");
                        caretDownMenu.classList.toggle("hidden");
                        navbar.classList.remove('active');
                            cart.classList.remove('active');
                        });
                        window.onscroll = () =>{
                            navbar.classList.remove('active');
                            cart.classList.remove('active');
                        }
                        

                        const logoutBtn = document.getElementById('logout-btn');
                        const confirmBox = document.getElementById('confirm-box');
                        const confirmYes = document.getElementById('confirm-yes');
                        const confirmNo = document.getElementById('confirm-no');

                        logoutBtn.addEventListener('click', () => {
                            confirmBox.style.display = 'block';
                        });

                        confirmYes.addEventListener('click', () => {
                            $.ajax({
                                type: 'POST',
                                url: 'logout.php',
                                success: function() {
                                    // Hide confirm box
                                    $('#confirm-box').hide();
                                                                    
                                    // Show success message with sweetalert
                                    Swal.fire({
                                        title: 'Logout successfully',
                                        icon: 'success',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                    }).then(() => {
                                        
                                            // Redirect to home page after 2 seconds
                                            window.location.href = 'home.php';
                                        
                                    });
                                }
                            });

                        });

                        confirmNo.addEventListener('click', () => {
                            confirmBox.style.display = 'none';
                        });


                        
                        
                    </script>







                    
                
           


    </header>

<!-- header section ends -->



