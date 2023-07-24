

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.css" integrity="sha512-yqCpLPABHnpDe3/QgEm1OO4Ohq0BBlBtJGMh5JbhdYEb6nahIm7sbtjilfSFyzUhxdXHS/cm8+FYfNstfpxcrg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>

</head>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  thead {
    background-color: #f9f9f9;
  }

  thead th {
    padding: 12px;
    text-align: left;
    font-weight: bold;
  }

  tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
  }

  tfoot td {
    padding: 12px;
    font-weight: bold;
    text-align: right;
    background-color: #f9f9f9;
  }

  input[type="number"] {
    width: 60px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  button[type="submit"],
  input[type="submit"] {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button[type="submit"]:hover,
  input[type="submit"]:hover {
    background-color: #45a049;
  }

  a {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    color: #333;
  }

  a:hover {
    text-decoration: underline;
  }

  tbody td img {
    max-width: 100px;
    max-height: 100px;
  }
</style>
<body>
<?php
session_start();
require_once "../connect.php";
$customer_id = $_SESSION['login'];

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}


if (isset($_POST['add_to_cart'])) {

  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  if (isset($_SESSION['cart'][$product_id])) {

    
    $_SESSION['cart'][$product_id] += $quantity;
  } else {

    $_SESSION['cart'][$product_id] = $quantity;
  }
}


if (isset($_POST['update_cart'])) {
  foreach ($_POST['quantity'] as $product_id => $quantity) {

    if ($quantity > 0) {
      $_SESSION['cart'][$product_id] = $quantity;
    } else {
      unset($_SESSION['cart'][$product_id]);
    }
  }
}


if (isset($_GET['remove'])) {
  $product_id = $_GET['remove'];

  unset($_SESSION['cart'][$product_id]);
}


if (isset($_POST['update_product'])) {
  $product_id = $_POST['update_product'];
  $new_quantity = $_POST['quantity'][$product_id];


  if ($new_quantity > 0) {
    $_SESSION['cart'][$product_id] = $new_quantity;
  } else {
    unset($_SESSION['cart'][$product_id]);
  }
}


if (isset($_POST['checkout'])) {
  $total_price = 0;
  $order_details = array();
  $total_quantity = 0;
  foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price = $row['price'];
    $subtotal = $price * $quantity;
    $total_price += $subtotal;


    $total_quantity +=  $quantity;

    $order_details[] = array(
      'product_id' => $product_id,
      'quantity' => $quantity,
      'price' => $price,
      'subtotal' => $subtotal
    );
  }

  


  $status = 'Pending';
  $sql = "INSERT INTO `order` (`userId`,  `totalPrice`, `quantity`, `status`) VALUES ('$customer_id','$total_price','$total_quantity', '$status')";
  mysqli_query($conn, $sql);

  $order_id = mysqli_insert_id($conn);

  foreach ($order_details as $order_detail) {
    $product_id = $order_detail['product_id'];
    $quantity = $order_detail['quantity'];
    $price = $order_detail['price'];
    $subtotal = $order_detail['subtotal'];
    $sql = "INSERT INTO orderdetail (orderId, productId, quantity, totalPrice) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
    mysqli_query($conn, $sql);
   
  }

  unset($_SESSION['cart']);
  echo "<script>
                        Swal.fire({
                            title: 'Successful payment!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = '../products.php';
                        });
                    </script>";
  exit();
}
?>
  <a href="../products.php">Continue to buy</a>
  <form action="" method="post">

  </form>
  <form method="post" action="cart.php">
    <table>
      <thead>
        <tr>
          <th></th>
          <th>Product</th>
          <th>Image</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total_price = 0;
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
         $sql = "SELECT * FROM product WHERE id = $product_id";
    
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $subtotal = $row['price'] * $quantity;
          $total_price += $subtotal;

          echo '<tr>';
          echo '<td><input type="checkbox" name="selected_products[]" value="' . $product_id . '"></td>';
          echo '<td>' . $row['name'] . '</td>';
          echo "<td><img src='../ADMIN/uploads/" . $row['img'] . "' alt='Product Image'></td>";
          echo '<td><input type="number" name="quantity[' . $product_id . ']" value="' . $quantity . '" onchange="calculateTotal()"></td>';
          echo '<td>' . $row['price'] . '</td>';
          echo '<td>' . $subtotal . '</td>';
          echo '<td>';
          echo '<a href="cart.php?remove=' . $product_id . '">delete</a>';
  
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">Total:</td>
          <td><?php echo $total_price; ?></td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    <script>
  // Hàm tính tổng số tiền
  function calculateTotal() {
    // Lấy tất cả các checkbox được chọn
    var checkboxes = document.querySelectorAll('input[name="selected_products[]"]:checked');
    var total = 0;

    // Lặp qua từng checkbox và tính tổng số tiền
    checkboxes.forEach(function (checkbox) {
      var row = checkbox.parentNode.parentNode;
      var quantity = parseInt(row.querySelector('input[name^="quantity"]').value);
      var price = parseFloat(row.querySelector('td:nth-child(5)').textContent);
      var subtotal = quantity * price;
      total += subtotal;
    });

    // Hiển thị tổng số tiền
    var totalElement = document.querySelector('tfoot td:nth-child(2)');
    totalElement.textContent = total;
  }

  // Gắn sự kiện change cho các checkbox
  var checkboxes = document.querySelectorAll('input[name="selected_products[]"]');
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', calculateTotal);
  });
</script>
    <input type="submit" name="update_cart" value="Cập nhật giỏ hàng">
    <input type="submit" name="checkout" value="Thanh toán" onclick="calculateTotal()">
  </form>
</body>

</html>
