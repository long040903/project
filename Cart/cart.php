<!-- cart.php -->
<?php
    session_start();
    require_once "../connect.php";
    // Kiểm tra nếu giỏ hàng không tồn tại, tạo mới giỏ hàng
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
        header('Location: cart.php');
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
        header('Location: cart.php');
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
            header('Location: cart.php');
            exit();
        }
    
        // ... mã PHP tiếp theo
    
        // Hiển thị danh sách sản phẩm trong giỏ hàng
        echo '<form method="post" action="cart.php">';
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
    
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><input type="number" name="quantity[' . $product_id . ']" value="' . $quantity . '"></td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $subtotal . '</td>';
            echo '<td>';
            echo '<button type="submit" name="update_product" value="' . $product_id . '">Sửa sản phẩm</button>';
            echo '<a href="cart.php?remove=' . $product_id . '">Xóa Sản Phẩm</a>';


    

   
            echo '</td>';
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
    
        // ... mã PHP tiếp theo
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

    </form>
  </body>
  </html>

