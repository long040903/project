<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- custom css file link -->
    <link rel="stylesheet" href="contact-us.css">

</head>
<body>
    <!-- header section starts -->
    <header class="header">
        <a href="#" class="logo">
            <img src="images/logo-tra-sua3.jpg">
        </a>

        <nav class="navbar">
            <a href="home-page.php">home</a>
            <a href="#about">about</a>
            <a href="our-menu.php">menu</a>
            <a href="#products">products</a>
            <a href="review.php">review</a>
            <a href="contact-us.php">contact us</a>
            <a href="#blogs">blogs</a>
        </nav>

        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"></div>
            <div class="fas fa-circle-user" id="user-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

         <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>

        <div class="cart-items-container">

            <div class="cart-item">
                <span class="fas fa-times"></span>
                    <img src="images/logo-tra-sua3.jpg" style="width: 90px;">
                    <div class="content">
                        <h3>cart item 01</h3>
                        <div class="price">$0.50</div>
                    </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times"></span>
                    <img src="images/logo-tra-sua3.jpg" style="width: 90px;">
                    <div class="content">
                        <h3>cart item 02</h3>
                        <div class="price">$0.50</div>
                    </div>
            </div>
            <div class="cart-item">
                <span class="fas fa-times"></span>
                    <img src="images/logo-tra-sua3.jpg" style="width: 90px;">
                    <div class="content">
                        <h3>cart item 03</h3>
                        <div class="price">$0.50</div>
                    </div>
            </div>
            <div class="cart-item"> 
                <span class="fas fa-times"></span>
                    <img src="images/logo-tra-sua3.jpg" style="width: 90px;">
                    <div class="content">
                        <h3>cart item 04</h3>
                        <div class="price">$0.50</div>
                    </div>
            </div>
            <a href="#" class="btn">check out now</a>
        </div> 
    </header>
    <!-- header setion ends -->

    <!-- contact section starts -->

    <section class="contact">

        <h1 class="heading"><span>contact</span> us </h1>

        <div class="row">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9265585566764!2d105.81637567512936!3d21.035624380615356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d6e603741%3A0x208a848932ac2109!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1682607232697!5m2!1svi!2s"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        <form action="">
            <h3>get in touch</h3>
            <div class="inputbox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name">
            </div>
            <div class="inputbox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="email">
            </div>
            <div class="inputbox">
                <span class="fas fa-phone"></span>
                <input type="number" placeholder="number">
            </div>
            <div class="inputbox">
                <textarea name="comment" id="textarea" cols="100" rows="10" placeholder="comment" ></textarea>
            </div>
            <input type="submit" value="contact now" class="btn">
        </form>
        </div>
    </section>
    <!-- contact section ends -->
</body>
</html>