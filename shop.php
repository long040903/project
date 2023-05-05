<?php 
require_once 'header.php';

require_once "connect.php";
require_once "Cart/cart.php";
require_once "Cart/addcart.php";

 
$images_folder = "ADMIN/uploads/";

?>


<div class="heading">
    <h1>our shop</h1>
    <p><a href="home.php">home >></a> shop </p>
</div>

<section class="category">

    <h1 class="title"> our <span>category</span><a href="#">view all >></a></h1>

    <div class="box-container">

        <a href="#" class="box">
            <img src="images/Category-rau.jpg" alt="">
        </a>

        <a href="#" class="box">
            <img src="images/Category-can-tay.webp" alt="">
        </a>

        <a href="#" class="box">
            <img src="images/Category-qua.webp" alt="">
        </a>
    </div>

</section>

<section class="products">

    <h1 class="title"> our <span>products</span><a href="#">view all >></a></h1>

    

        
            
            <?php
                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);
               
               
                // In ra thông tin sản phẩm
                if (mysqli_num_rows($result) > 0) {
                    // Duyệt qua các hàng trong bảng sản phẩm
                    echo '<div class="box-container">';
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        echo '<div class="box">';
                        $image_path = $images_folder . $row['img'];
                        if (file_exists($image_path)) {
                            echo '<div class="image">';
                            echo "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents($image_path)) . "' alt='Hình ảnh sản phẩm'>";
                            echo '</div>';
                        } else {
                            echo "<p>Không tìm thấy ảnh sản phẩm</p>";
                        }

                        
                        echo '<div class="content">';
                        echo "<h3>" . $row["name"]. "</h3>";
                        echo '<div class="price">' . $row["price"]. '</div>';
                        echo '</div>';
                        

                        echo '<div class="form">';
                         echo '<form class="icons" method="POST" action="cart.php">';
                         echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                         echo '<a class="fas fa-eye" href="../Product/detail.php?id=' . $row["id"] . '"></a>';
                         echo '</form>';
                         echo' <form action="../Cart/cart.php" method="POST">';
                         echo '<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">' ;
                         echo' <a type="submit" name="add_to_cart" value="Thêm vào giỏ hàng"></a>';
                         echo'</form>';
                         echo '</div>';
                         echo '</div>';
                         
                    }
                    echo '</div>';
                } else {
                    echo "Không có sản phẩm nào";
                }
              
                
                // Đóng kết nối
                mysqli_close($conn);
                ?>
            
            
        


    

</section>





































<?php
require_once 'footer.php'
?>