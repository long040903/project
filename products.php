<?php 
require_once 'header.php';
// ini_set("display_errors", "1");
// ini_set("display_startup_errors", "1");
// error_reporting(E_ALL);

require_once "connect.php";
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: ../Login/login.php');

}


$user_id = $_SESSION['login'];

$images_folder = "ADMIN/uploads/";

?>

<div class="heading">
    <h1>our shop</h1>
    <p><a href="home.php">home >></a> shop </p>
</div>


<section class="products">



                    <div class="form" >
                        <form method="get">
                            <input type="text" name="search_query" placeholder="find products">
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
                                // Show a list of products on the page
                                
                                $sql = "SELECT * FROM product WHERE LOWER(name) LIKE '%$search_query%'";
                                $result = $conn->query($sql);
                    
                                if ($result->num_rows > 0) {
                                    echo '<div class="box-container">';
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="box">';
                                        echo "<a href='detail.php?id=" . $row["id"] . "'>";
                                        echo '<div class="image">';
                                        echo "<img src='".$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']."/E_Project_Group_2_C2209G/SOURCE/ADMIN/uploads/" . $row["img"] . "' alt='" . $row["name"] . "'/>";
                                        echo '</div>';
                                        echo '<div class="content">';
                                        echo "<h3>" . $row["name"] . "</h3>";
                                        echo '<div class="price">' . $row["price"] . '</div>';
                                        echo "</a>";
                                        echo '</div>';
                                        

                                        echo '<div class="form">';
                                        echo '<form class="icons" method="POST" action="Cart/cart.php">';
                                        echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                                        echo '<a class="fas fa-eye" href="detail.php?prd_id=' . $row["id"] . '"></a>';
                                        echo '</form>';
                                        echo' <form action="Cart/cart.php" method="POST">';
                                        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                                        echo "<input type='hidden' name='quantity' id='quantity' value='1' min='1'>"; 
                                        echo' <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>';
                                        echo'</form>';
                                        echo '</div>';
                                        echo '</div>';



                                        
                                    }
                                    echo '</div>';
                                } else {
                                    echo "<div class='result'>No products found.</div>";
                                    
                                }
                                
                            } else {
                                echo "<div class='result'>No products found.</div>";
                            }
                        } else {
                            echo "<div class='result'>Please enter search keywords.</div>";
                        }
                    }else{
                        $sql = "SELECT * FROM product";
                        $result = mysqli_query($conn, $sql);
                        // dd($result);
                        // Determine the number of records per page
                        $records_per_page = 6;

                        // Define the current page
                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                            $current_page = (int) $_GET['page'];
                        } else {
                            $current_page = 1;
                        }

                        // Calculate the number of start and end records of the current page
                        $offset = ($current_page - 1) * $records_per_page;

                        // Execute a query that counts the total number of records
                        $result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM product");

                        // Get the result of counting the total number of records
                        $row = mysqli_fetch_assoc($result);
                        $total_records = $row['total_records'];

                        // Calculate the number of pages
                        $total_pages = ceil($total_records / $records_per_page);

                        // Perform a query that fetches a record for the current page
                        $sql = "SELECT * FROM product LIMIT $offset, $records_per_page";
                        $result = mysqli_query($conn, $sql);
                        // dd($result);

               
                // Print out product information
                if (mysqli_num_rows($result) > 0) {
                    // Browse rows in the products table
                    echo '<div class="box-container">';
                    while($row = mysqli_fetch_assoc($result)) {
                        
                        echo '<div class="box">';
                        $image_path = $images_folder . $row['img'];
                        if (file_exists($image_path)) {
                            echo '<div class="image">';
                            echo "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents($image_path)) . "' alt='Product Images'>";
                            echo '</div>';
                        } else {
                            echo "<p>Product photo not found</p>";
                        }

                        
                        echo '<div class="content">';
                        echo "<h3>" . $row["name"]. "</h3>";
                        echo '<div class="price">' . $row["price"]. '</div>';
                        echo '</div>';
                        

                        echo '<div class="form">';
                         echo '<form class="icons" method="POST" action="cart.php">';
                         echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                         echo '<a class="fas fa-eye" href="detail.php?prd_id=' . $row["id"] . '"></a>';
                         echo '</form>';
                         echo' <form action="./Cart/cart.php" method="POST">';
                         echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                         echo "<input type='hidden' name='quantity' id='quantity' value='1' min='1'>"; 
                         echo' <button type="submit" name="add_to_cart" class="fas fa-shopping-cart"></button>';
                         echo'</form>';
                         echo '</div>';
                         echo '</div>';
                         
                    }
                    echo '</div>';
                } else {
                    echo "No products";
                }
              
                }
                // Close a connection
                mysqli_close($conn);

                // Show pagination
                if ($total_pages > 1) {
                    echo "<ul class='pagination'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo "<li class='active'><a href='?page=$i'>$i</a></li>";
                        } else {
                            echo "<li><a href='?page=$i'>$i</a></li>";
                        }
                    }
                    echo "</ul>";
                }
            
                    ?>

            
            
</section>








<?php
require_once 'footer.php';
?>