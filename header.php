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
                               


                            if (!isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = array();
                            }
                            // Kiểm tra nếu người dùng đã ấn nút "Thêm vào giỏ hàng"
                            if (isset($_POST['add_to_cart'])) {
                            // Lấy thông tin sản phẩm từ form
                            $product_id = $_POST['product_id'];
                            $quantity = $_POST['quantity'];

                            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                            if (isset($_SESSION['cart'][$product_id])) {
                                // Nếu đã có, cộng thêm số lượng
                                $_SESSION['cart'][$product_id] += $quantity;
                            } else {
                                // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng
                                $_SESSION['cart'][$product_id] = $quantity;
                            }

                            // Chuyển hướng về trang cart.php để hiển thị giỏ hàng

                            
                            }
                            // Kiểm tra nếu người dùng đã ấn nút "Cập nhật giỏ hàng"
                            if (isset($_POST['update_cart'])) {
                            foreach ($_POST['quantity'] as $product_id => $quantity) {
                                // Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng
                                if ($quantity > 0) {
                                    $_SESSION['cart'][$product_id] = $quantity;
                                } else {
                                    unset($_SESSION['cart'][$product_id]);
                                }
                            }

                            // Tính lại tổng số tiền sau khi cập nhật giỏ hàng
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $sql = "SELECT price FROM product WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $subtotal = $row['price'] * $quantity;
                                $total_price += $subtotal;
                            }

                            // Chuyển hướng về trang cart.php để hiển thị giỏ hàng sau khi cập nhật
                            header('Location: order.php');
                            exit();
                            }

                            // Kiểm tra nếu người dùng đã ấn nút "Xóa sản phẩm"
                            if (isset($_GET['remove'])) {
                            $product_id = $_GET['remove'];

                            // Xóa sản phẩm khỏi giỏ hàng
                            unset($_SESSION['cart'][$product_id]);

                            // Tính lại tổng số tiền sau khi xóa sản phẩm
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $sql = "SELECT price FROM product WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $subtotal = $row['price'] * $quantity;
                                $total_price += $subtotal;
                            }

                            // Chuyển hướng về trang cart.php để hiển thị giỏ hàng sau khi xóa
                            header('Location: order.php');
                            exit();
                            }

                            // Kiểm tra nếu người dùng đã ấn nút "Sửa sản phẩm"
                            if (isset($_POST['update_product'])) {
                            $product_id = $_POST['update_product'];
                            $new_quantity = $_POST['quantity'][$product_id];

                            // Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng
                            if ($new_quantity > 0) {
                                $_SESSION['cart'][$product_id] = $new_quantity;
                            } else {
                                unset($_SESSION['cart'][$product_id]);
                            }

                            // Tính lại tổng số tiền sau khi sửa sản phẩm
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $sql = "SELECT price FROM product WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $subtotal = $row['price'] * $quantity;
                                $total_price += $subtotal;
                                }

                                // Chuyển hướng về trang cart.php để hiển thị giỏ hàng sau khi sửa sản phẩm
                                header('Location: order.php');
                                exit();
                            }
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                    $prd_id = $product_id;
                                    $sql = "SELECT price FROM product WHERE id = $product_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $subtotal = $row['price'] * $quantity;
                                    $total_price += $subtotal;
                                }

                                // Kiểm tra nếu người dùng đã ấn nút "Xác thanh toán"
                                if (isset($_POST['checkout'])) {
                                    $customer_id = $_SESSION['login'];
                                    $order_date = date('Y-m-d H:i:s');
                                    $status = 'Pending';
                                    $sql = "INSERT INTO `order` (`userId`, `productId`, `totalPrice`, `quantity`, `status`) VALUES ('$customer_id', '$prd_id','$total_price','$quantity', '$status')";
                                    mysqli_query($conn, $sql);

                                    $order_id = mysqli_insert_id($conn);

                                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                        $sql = "SELECT * FROM product WHERE id = $product_id";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $price = $row['price'];

                                        $sql = "INSERT INTO orderdetail (orderId, productId, quantity, totalPrice) VALUES ('$order_id', '$product_id', '$quantity', '$total_price')";
                                        mysqli_query($conn, $sql);

                                    }

                                    unset($_SESSION['cart']);
                                    echo "thanh toán thành công";
                                    echo '<a href="products.php">tiếp tục mua hàng</a>';
                                    exit();
                                }

                            }

                         

                            // Hiển thị danh sách sản phẩm trong giỏ hàng
                            echo '<form method="post" action="order.php">';
                            echo '<table>';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Product</th>';
                            echo '<th>Quantity</th>';
                            echo '<th>Price</th>';
                            echo '<th>Subtotal</th>';
                            echo '<th>Action</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            $total_price = 0;

                            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                $sql = "SELECT * FROM product WHERE id = $product_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $subtotal = $row['price'] * $quantity;
                                $total_price += $subtotal;
                                $image_path = $images_folder . $row['img'];
                        
                            
                                echo '<tr>';
                                echo '<td><img src="ADMIN/uploads/' . $row["img"] . '" alt="' . $row["name"] . '"></td>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td><input type="number" name="quantity[' . $product_id . ']" value="' . $quantity . '"></td>';
                                echo '<td>' . $row['price'] . '</td>';
                                echo '<td>' . $subtotal . '</td>';
                                echo '<td>';
                                echo '<button type="submit" name="update_product" value="' . $product_id . '">Sửa sản phẩm</button>';
                                echo '<td colspan="5"><input type="submit" name="checkout" value="Checkout"></td>';
                                echo '<td><a href="order.php?remove=' . $product_id . '">Xóa Sản Phẩm</a></td>';
                                echo '</tr>';
                            }
                            

                            echo '</tbody>';
                            echo '<tfoot>';
                            echo '<tr>';
                            echo '<td colspan="3">Total:</td>';
                            echo '<td>' . $total_price . '</td>';
                            // echo '<td><input type="submit" name="update_cart" value="Update Cart"></td>';
                            echo '</tr>';
                            echo '</tfoot>';
                            echo '</table>';
                            echo '</form>';





                            ?>
                            <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Document</title>
                            </head>
                            <body>
                                <a href="../Login/home.php">Tiếp tục mua hàng</a>
                            <form action=""  method="post">
                            <input type="submit" name="checkout" value="Mua Hàng">
                            </form>
                                </form>
                            </body>
                            </html>



                    <a class="fas fa-times"></a>
                    <img src="images/kiwi-ep.jpeg" alt="">
                    <div class="content">
                        <form action="order.php" method="post">
                        <h3>kiwi juice</h3>
                        <span class="quantity">1</span>
                        <span class="multiply">x</span>
                        <span class="price">35000 VNĐ</span>
                        </form>
                    </div>
                </div>



                <div class="box">
                    <a class="fas fa-times"></a>
                    <img src="images/kiwi-ep.jpeg" alt="">
                    <div class="content">
                        <h3>kiwi juice</h3>
                        <span class="quantity">1</span>
                        <span class="multiply">x</span>
                        <span class="price">35000 VNĐ</span>
                    </div>
                </div>

                <div class="box">
                    <a class="fas fa-times"></a>
                    <img src="images/kiwi-ep.jpeg" alt="">
                    <div class="content">
                        <h3>kiwi juice</h3>
                        <span class="quantity">1</span>
                        <span class="multiply">x</span>
                        <span class="price">35000 VNĐ</span>
                    </div>
                </div>
                <h3 class="total">total: <span>103000 VNĐ</span></h3>
                <a href="#" class="btn">checkout cart</a>
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
                            echo '<i class="fas fa-hand-point-down"></i><a href="login.php" class="btn">login now</a>'; // hiển thị icon user nếu chưa đăng nhập
                            
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



