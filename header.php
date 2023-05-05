<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="home.css">

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
            <div id="search-btn" class="fas fa-search"></div>
            <div id="cart-btn" class="fas fa-shopping-cart"></div>
            <a href="login.php" id="login-btn" class="fas fa-circle-user"></a>
        </div>

        <form action="" class="search-form">
            <input type="search" placeholder="search here..." id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="shopping-cart">
            <div class="box">
                <i class="fas fa-times"></i>
                <img src="images/nuoc-ep4.jpg" alt="">
                <div class="content">
                    <h3>juice</h3>
                    <span class="quantity">1</span>
                    <span class="multiply">x</span>
                    <span class="price">$0.8</span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="images/nuoc-ep6.jpg" alt="">
                <div class="content">
                    <h3>juice</h3>
                    <span class="quantity">1</span>
                    <span class="multiply">x</span>
                    <span class="price">$0.8</span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-times"></i>
                <img src="images/nuoc-ep7.jpg" alt="">
                <div class="content">
                    <h3>juice</h3>
                    <span class="quantity">1</span>
                    <span class="multiply">x</span>
                    <span class="price">$0.8</span>
                </div>
            </div>
            <h3 class="total"> total: <span>0.36</span></h3>
            <a href="#" class="btn">checkout cart</a>
        </div>

    </header>

<!-- header section ends -->
