<?php
session_start();
if (isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	if (isset($_SESSION['cart'][$product_id])) {
		$_SESSION['cart'][$product_id]++;
	} else {
		$_SESSION['cart'][$product_id] = 1;
	}
}
header('Location: products.php');
?>



<!DOCTYPE html>
<html>
<head>
	<title>Danh sách sản phẩm</title>
</head>
<body>
	<h1>Danh sách sản phẩm</h1>
	<ul>
		<li>
			<h3>Sản phẩm 1</h3>
			<p>Giá: $10</p>
			<form method="post" action="cart.php">
				<input type="hidden" name="product_id" value="1">
				<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">
			</form>
		</li>
		<li>
			<h3>Sản phẩm 2</h3>
			<p>Giá: $20</p>
			<form method="post" action="cart.php">
				<input type="hidden" name="product_id" value="2">
				<input type="submit" name="add_to_cart" value="Thêm vào giỏ hàng">
			</form>
		</li>
		<!-- Thêm các sản phẩm khác -->
	</ul>
</body>
</html>
