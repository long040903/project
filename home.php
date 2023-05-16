<?php
require_once 'header.php';
session_start();
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);
if (!isset($_SESSION['login'])) {
    header('Location: ../Login/login.php');
  
  }
  $user_id = $_SESSION['login'];

?>



<section class="home">

    <div class="slides-container">

        <div class="slide active">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep1.jpeg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep2.webp" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep3.jpg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep4.jpg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/chanh-leo-ep.jpg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep7.jpg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/nuoc-ep-thanh-long.webp" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/kiwi-ep.jpeg" alt="">
            </div>
        </div>

        <div class="slide">
            <div class="content">
                <span>fresh and organic</span>
                <h3>upto 50% off</h3>
            </div>
            <div class="image">
                <img src="images/dao-ep.jpg" alt="">
            </div>
        </div>

    </div>

    <div id="next-slide" class="fas fa-angle-right" onclick="next()"></div>
    <div id="prev-slide" class="fas fa-angle-left" onclick="next()"></div>

</section>

<section class="banner-container">

    <div class="banner">
        <img src="images/Category-can-tay.webp" alt="">
        <div class="content">
            
            
            
            <span>vegetables juice sales</span>
            <h3>upto 50% off</h3>
            <a href="#" class="btn">shop now</a>
        </div>
    </div>

    <div class="banner">
        <img src="images/Category-qua.webp" alt="">
        <div class="content">
            <span>fruits sales</span>
            <h3>upto 50% off</h3>
            <a href="#" class="btn">shop now</a>
        </div>
    </div>

    <div class="banner">
        <img src="images/Category-hat.webp" alt="">
        <div class="content">
            <span>cereal grains sales</span>
            <h3>upto 50% off</h3>
            <a href="#" class="btn">shop now</a>
        </div>
    </div>

</section>






<?php
require_once 'footer.php'
?>