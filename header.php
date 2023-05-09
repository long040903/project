<?php
session_start();
require_once "connect.php";

require_once 'ADMIN/utils.php';
error_reporting(0);
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
    <link rel="stylesheet" href="home1.css?ver">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>
    
<!-- header section starts -->

    <header class="header">

        <a href="home.php" class="logo"><i class="icofont-juice"></i> juice </a>

        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="products.php">products</a>
            <a href="about.php">about</a>
            <a href="review.php">review</a>
            <a href="blog.php">blogs</a>
            <a href="contact.php">contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="cart-btn" class="fas fa-shopping-cart"></div>
            <div class="fas fa-circle-user" id="caret-down">
                <div class="caret_down">
                
                
                    
                        <?php
                        echo '<div class="box">';
                        if (   isset($_POST['showuser']  ) ) {
                            
                            $username = $_POST['username'];
                            $password = sha1 ($_POST['password']);
                            $email = $_POST['email'];
                            $phoneNumber = $_POST['phone_number'];
                            $_SESSION['username'] = $_POST['username'];
                            $_SESSION['email'] = $_POST['email']; // lưu tên người dùng vào biến toàn cục
                            header('Location: home.php'); // chuyển hướng đến trang home
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
                            echo '<i class="fa fa-user"></i><a href="login.php" class="btn">login now</a>'; // hiển thị icon user nếu chưa đăng nhập
                            
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
                        });
                        
                        

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
                                    // Show success message
                                    $('#logout-success').show();
                                                            
                                    // Hide confirm box
                                    $('#confirm-box').hide();
                                                        
                                    // Redirect to home page after 3 seconds
                                    setTimeout(function() {
                                        window.location.href = 'home.php';
                                    }, 1000);
                                }
                            });
                        });

                        confirmNo.addEventListener('click', () => {
                            confirmBox.style.display = 'none';
                        });


                        
                        
                    </script>







                    
                
           
        
        

    </header>

<!-- header section ends -->



