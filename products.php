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


<section class="products">



                    <div class="form" >
                        <form method="get">
                            <input type="text" name="search_query" placeholder="Tìm kiếm sản phẩm">
                            <button type="submit" ><i class="fas fa-search"></i></button>
                        </form>
                    </div>



<h1 class="title"> our <span>products</span><a href="#">view all >></a></h1>



                    

                    <?php
                    if (isset($_GET['search_query'])) {
                        $search_query = strtolower($_GET['search_query']);
                        $search_query = trim(preg_replace('/\s+/', ' ', $search_query));
                    
                        if (!empty($search_query)) {
                            $sql = "SELECT * FROM product WHERE LOWER(name) LIKE '%$search_query%'";
                            $result = $conn->query($sql);
                            // dd($_SERVER);
                    
                            if ($result->num_rows > 0) {
                                // Hiển thị danh sách sản phẩm trên trang
                                
                                $sql = "SELECT * FROM product WHERE LOWER(name) LIKE '%$search_query%'";
                                $result = $conn->query($sql);
                    
                                if ($result->num_rows > 0) {
                                    echo '<div class="box-container">';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="box">';
                                        echo "<a href='detail.php?id=" . $row["id"] . "'>";
                                        echo '<div class="image">';
                                        echo "<img src='".$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']."/PROJECT_KI1/ADMIN/uploads/" . $row["img"] . "' alt='" . $row["name"] . "'/>";
                                        echo '</div>';
                                        echo '<div class="content">';
                                        echo "<h3>" . $row["name"] . "</h3>";
                                        echo '<div class="price">' . $row["price"] . '</div>';
                                        echo "</a>";
                                        echo '</div>';
                                        

                                        echo '<div class="form">';
                                        echo '<form class="icons" method="POST" action="cart.php">';
                                        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                                        echo '<a class="fas fa-eye" href="detail.php?id=' . $row["id"] . '"></a>';
                                        echo '</form>';
                                        echo' <form action="Cart/cart.php" method="POST">';
                                        echo '<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">' ;
                                        echo' <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>';
                                        echo'</form>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                } else {
                                    echo "<div class='result'>Không tìm thấy sản phẩm nào.</div>";
                                    
                                }
                                
                            } else {
                                echo "<div class='result'>Không tìm thấy sản phẩm nào.</div>";
                            }
                        } else {
                            echo "<div class='result'>Vui lòng nhập từ khóa tìm kiếm.</div>";
                        }
                    
                        $conn->close();
                        }else{
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
                         echo '<a class="fas fa-eye" href="detail.php?id=' . $row["id"] . '"></a>';
                         echo '</form>';
                         echo' <form action="Cart/cart.php" method="POST">';
                         echo '<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">' ;
                         echo' <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>';
                         echo'</form>';
                         echo '</div>';
                         echo '</div>';
                         
                    }
                    echo '</div>';
                } else {
                    echo "Không có sản phẩm nào";
                }
              
                }
                // Đóng kết nối
                mysqli_close($conn);
            
                    ?>

            <?php ?>
            <?php
                
                ?>
                <?php ?>
            
</section>








<?php
require_once 'footer.php';
?>