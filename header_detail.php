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
    <link rel="stylesheet" href="header_detail.css">

</head>
<body>
    
<!-- header section starts -->

    <header class="header">

        <a href="home.php" class="logo"><i class="icofont-juice"></i> juice </a>

        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="shop.php">shop</a>
            <a href="about.php">about</a>
            <a href="review.php">review</a>
            <a href="blog.php">blogs</a>
            <a href="contact.php">contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="cart-btn" class="fas fa-shopping-cart"></div>
            <a href="login.php" id="login-btn" class="fas fa-circle-user"></a>
            <div class="fas fa-caret-down" id="caret-down">
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
                            
                            echo '<span>';
                            echo 'Name: ' . $_SESSION['username'];
                            echo '</span><br>';
                            if (isset($_SESSION['email'])) {
                                echo '<span>';
                                echo 'Email: '. $_SESSION['email'];
                                echo '</span>';
                            }
                        } else {
                            echo '<i class="fa fa-user"></i>'; // hiển thị icon user nếu chưa đăng nhập
                            
                        }
                        echo '</div>';
                        echo '</div>';
                                    
                                
                           ?>
                    <a href="logout.php" class="btn">logout</a>
                    

                    
                
            </div>
            </div>

            
        </div>

        <form action="" method="post" class="search-form">
            <input type="text" name="search_query" placeholder="search here..." id="search-box">
            <button type="submit" for="search-box" class="fas fa-search"></button>
        </form>
        
        

    </header>

<!-- header section ends -->



