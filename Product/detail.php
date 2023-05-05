<?php
require_once '../header.php';
?>


<?php
session_start();
require_once "../connect.php";
$images_folder = "../ADMIN/uploads/";
$product_id = $_GET["id"];
// Truy vấn sản phẩm có ID tương ứng
$sql = "SELECT * FROM product WHERE id = " . $product_id;
$result = mysqli_query($conn, $sql);

// Hiển thị thông tin chi tiết sản phẩm
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  echo "<p>" . $row["name"]. "</p>";
                       echo "<p>" . $row["price"]. "</p>";
                       $image_path = $images_folder . $row['img'];
                       if (file_exists($image_path)) {
                           echo "<img src='data:image/jpeg;base64," . base64_encode(file_get_contents($image_path)) . "' alt='Hình ảnh sản phẩm'>";
                       } else {
                           echo "<p>Không tìm thấy ảnh sản phẩm</p>";
                       }
} else {
  echo "Product not found";
}
echo '</form>';
echo' <form action="../Cart/cart.php" method="POST">';
echo '<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">' ;
echo '<label for="quantity">Quantity:</label>';
echo'  <input type="number" name="quantity" id="quantity" value="1" min="1">';
echo' <input type="submit" name="add_to_cart" value="Add to cart">';
echo'</form>';

// Đóng kết nối
mysqli_close($conn);
?>
















<?php
require_once '../footer.php';
?>