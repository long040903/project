
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>complete responsive drink shop website design</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- custom css file link -->
    <link rel="stylesheet" href="home-page1.css">

</head>
<body>
    <!-- header section starts -->
    <header class="header">
        <a href="#" class="logo">
            <img src="images/logo-tra-sua3.jpg">
        </a>

        <nav class="navbar">
            <a href="#home">home</a>
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

    <!-- home setion starts -->

    <section class="home" id="home">
        <div class="content">
            <h3>milk tea in the evening</h3>
            <p>lorem ipsum, dolor sit amet consectetur adipisicing elit.placeat labore, sint cupiditate distinctio tempora reiciendis</p>
            <a href="#" class="btn">get your now</a>
        </div>
    </section>

    <!-- home section ends -->

    <!-- about section starts -->

    <section class="about" id="about">
        <h1 class="heading"><span>about</span> us </h1>
        <div class="row">
            <div class="image">
                <img src="images/latte6.webp" alt="">
            </div>
            <div class="content">
                <h3>what makes our milk tea special?</h3>
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus qui eaullam, enim tempora ipsum fuga alias quae ration a officiis id temporibus autem? Quod nemo facilis cupiditate. Ex, vel?</p>
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Odit amet enim quod veritatis, nihil voluptas culpa! Neque consectetur obcaecati sapiente?</p>
                <a href="#" class="btn">learn more</a>
            </div>
        </div>
    </section>

    <!-- about section ends -->

    <!-- menu section starts -->

    <section class="menu" id="menu">
        <h1 class="heading"> our <span>menu</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="images/ca-phe3.jpeg" alt="">
                <h3>Shaped milk coffee</h3>
                <div class="price">$1.49 - $1.92 </div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <img src="images/tra-sua2.jpeg" alt="">
                <h3>Black sugar pearl milk tea</h3>
                <div class="price">$1.06 - $1.28 </div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <img src="images/tra7.jpeg" alt="">
                <h3>Red tea</h3>
                <div class="price">$1.06 </div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <img src="images/nuoc-ep1.jpeg" alt="">
                <h3>Pineapple juice</h3>
                <div class="price">$1.06 - $1.28 </div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <img src="images/ca-phe2.jpeg" alt="">
                <h3>Black coffee</h3>
                <div class="price">$0.85 </div>
                <a href="#" class="btn">add to cart</a>
            </div>

            <div class="box">
                <img src="images/tra-sua7.jpeg" alt="">
                <h3>Milk tea for science</h3>
                <div class="price">$1.06 - $1.28 </div>
                <a href="#" class="btn">add to cart</a>
            </div>
        </div>
    </section>

    <!-- menu section ends -->

    <!-- product section starts -->

    <section class="products" id="products">

        <h1 class="heading"> our <span>products</span></h1>

        <div class="box-container">

            <div class="box">
                <div class="icons">
                    <a href="#" class="fas fa-shopping-cart"></a>
                    <a href="#" class="fas fa-thumbs-up"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="images/ca-phe4.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>fresh milk tea</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">$0.8 </div>
                </div>
            </div>

            <div class="box">
                <div class="icons">
                    <a href="#" class="fas fa-shopping-cart"></a>
                    <a href="#" class="fas fa-thumbs-up"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="images/nuoc-ep2.webp" alt="">
                </div>
                <div class="content">
                    <h3>fresh milk tea</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">$0.8 </div>
                </div>
            </div>

            <div class="box">
                <div class="icons">
                    <a href="#" class="fas fa-shopping-cart"></a>
                    <a href="#" class="fas fa-thumbs-up"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <div class="image">
                    <img src="images/tra-sua7.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>fresh milk tea</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">$0.8 </div>
                </div>
            </div>
        </div>
    </section>

    <!-- product section ends -->

    <!-- review section starts -->

    <section class="review" id="review">

        <h1 class="heading"> customer`s <span>review</span></h1>
        <div class="box-container">

            <div class="box">

                <img src="images/img-daukep.png" style="width: 30%;">
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero meno fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
                <img src="images/khoailangthang.jpeg" class="user" alt="">
                <h3>khoailangthang</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="box">

                <img src="images/img-daukep.png" style="width: 30%;">
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero meno fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
                <img src="images/ninhtito.jpeg" class="user" alt="">
                <h3>NinhTiTo</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="box">

                <img src="images/img-daukep.png" style="width: 30%;">
                <p>lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero meno fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
                <img src="images/ansaphn.jpeg" class="user" alt="">
                <h3>Ăn sập HN</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- review section ends -->

    <!-- contact section starts -->

    <section class="contact-us" >

        <h1 class="heading"><span>contact</span> us </h1>
        <div class="row">

            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9265585586936!2d105.816370310685!3d21.035624380534653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d6e603741%3A0x208a848932ac2109!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1681889055619!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
            <div class="form">
                <h3>get in touch</h3>
                <div class="inputBox">
                    <span class="fas fa-location-dot"></span>
                    <p class="title">Aptech computer education</p>
                    
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <a href="mailto:web-nhom-2@gmail.com" class="title">web-nhom-2@gmail.com</a>

                    
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <a href="tel:0386296319" class="title">0386296319</a>
                </div>
                    <button type="submit" id="button" class="btn" onclick="contact()">contact now</button>
            </div>
                
            
        </div>
    </section>

    <!-- contact section ends -->

    <!-- blogs section starts -->

    <section class="blogs" id="blogs">

        <h1 class="heading"> our <span>blogs</span></h1>
        <div class="box-container">

            <div class="box">
                <div class="image">
                    <img src="images/images/images (1).jpeg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">tasty and refreshing milk tea</a>
                    <span>by admin / 21st may, 2023</span>
                    <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Non, dicta.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/images/images (1).jpeg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">tasty and refreshing milk tea</a>
                    <span>by admin / 21st may, 2023</span>
                    <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Non, dicta.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/images/images (1).jpeg" alt="">
                </div>
                <div class="content">
                    <a href="#" class="title">tasty and refreshing milk tea</a>
                    <span>by admin / 21st may, 2023</span>
                    <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Non, dicta.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
        </div>
    </section>
    <!-- blogs section ends -->

    <!-- footer section starts -->

    <footer>
        <div class="container">
            <!--Bắt Đầu Nội Dung Giới Thiệu-->
            <div class="title about">
                <h2>About me</h2>
                <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium dolores alias ipsa vel hic
                   tempore exercitationem ipsam explicabo repudiandae ut consectetur qui, earum at nostrum perspiciatis
                   asperiores necessitatibus facilis esse.
                   Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia id possimus quibusdam nihil earum in
                   provident enim animi commodi quisquam! Molestiae cupiditate mollitia pariatur error ea, debitis
                   eaque quo dolorum.</p>
                
            </div>
            <!--Kết Thúc Nội Dung Giới Thiệu-->
            <!--Bắt Đầu Nội Dung Đường Dẫn-->
            <div class="title links">
                <h2>Links</h2>
                <ul>
                    <li><a href="home-page.html">Home page</a></li>
                    <li><a href="#">About me</a></li>
                    <li><a href="#">Contact Information</a></li>
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Policy conditions</a></li>
                </ul>
            </div>
            <div class="title contact">
                <h2>Contact Information</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa fa-location-dot"></i></span>
                        <span>Aptech Computer Education<br />
                            APTECH Building, Doi Can 285, Lieu Giai, Ba Dinh<br />
                            Ha Noi</span>
                    </li>
                    <li>
                        <span><i class="fa fa-phone"></i></span>
                        <p><a href="tel:0386296319">+84 86296319</a>
                            <br />
                            
                    </li>
                    <li>
                        <span><i class="fa fa-envelope"></i></span>
                        <p><a href="mailto:web-nhom-2@gmail.com">web-nhom-2@gmail.com</a></p>
                   </li>
                    
                </ul>
            </div>
        </div>
    </footer>

    <section class="footer">

        <div class="share">
            <a href="#" class="fab fa-facebook"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
            <a href="#" class="fab fa-pinterest"></a>
        </div>
        <div class="credit">created by <span>nhóm 2</span> | all rights reserved</div>
    </section>

    <!-- footer section starts -->











    <script src="home-page.js"></script>
</body>
</html>