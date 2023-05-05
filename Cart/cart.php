<?php
session_start();
if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];


  // Lưu thông tin sản phẩm và số lượng vào giỏ hàng
  $_SESSION['cart'][$product_id] = array(
    'quantity' => $quantity,
    'price' => $product_price
  );

  // Chuyển hướng đến trang giỏ hàng
  header('Location:Cart/cart.php');
  exit;
}

// Lấy thông tin sản phẩm từ giỏ hàng
$cart_items = $_SESSION['cart'];

// Tính tổng số tiền
$total_price = 0;
foreach ($cart_items as $product_id => $item) {
  $total_price += $item['quantity'] * $item['price'];
}



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


  <h2>Giỏ hàng</h2>
  <table>
    <thead>
      <tr>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Thành tiền</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart_items as $product_id => $item) : ?>
        <tr>
      
          <td><?php echo $item['quantity']; ?></td>
          <td><?php echo number_format($item['price']); ?> đ</td>
          <td><?php echo number_format($item['quantity'] * $item['price']); ?> đ</td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="3">Tổng số tiền:</td>
        <td><?php echo number_format($total_price); ?> đ</td>
      </tr>
    </tbody>
  </table>

</body>

</html>