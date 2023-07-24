<?php
require_once 'header_qladmin.php';
?>


<style>
    h1{
        text-align: center;
        margin-bottom: 10px;
    }
    .order-list {
        width: 100%;
        border: 1px solid;
    border-radius: 10px;
    }
    .order-list th, .order-list td {
        padding: 8px;
        text-align: left;
    }
    .order-list th {
        background-color: #f2f2f2;
    }
    .pagination {
        margin-top: 20px;
    }
    .pagination a {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        color: #000;
        border: 1px solid #ddd;
    }
    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }
    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>



<?php

require_once "connect.php";


$countSql = "SELECT COUNT(*) AS total FROM `order`";
$countResult = $conn->query($countSql);
$totalItems = $countResult->fetch_assoc()['total'];


$itemsPerPage = 10;


$totalPages = ceil($totalItems / $itemsPerPage);


$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($currentPage - 1) * $itemsPerPage;
$sql = "SELECT user.username, user.phoneNumber, user.address, product.name, orderdetail.quantity, product.price, `order`.status FROM `order` INNER JOIN orderdetail on `order`.`id` = orderdetail.orderId INNER JOIN product ON orderdetail.productId= product.id INNER join user on `order`.`userId`= user.id
        LIMIT $start, $itemsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>list orders</h1>";
    echo "<table class='order-list'>";
    echo "<tr>
            <th>name</th>
            <th>phone</th>
            <th>address</th>
            <th>name product</th>
            <th>quantity</th>
            <th>price</th>
            <th>condition</th>
          </tr>";


    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["username"] . "</td>";
      echo "<td>" . $row["phoneNumber"] . "</td>";
      echo "<td>" . $row["address"] . "</td>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["quantity"] . "</td>";
      echo "<td>" . $row["price"] . "</td>";
      echo "<td>" . $row["status"] . "</td>";
      echo "</tr>";
      }
      echo "</table>";


echo "<div class='pagination'>";
$previousPage = $currentPage - 1;
$nextPage = $currentPage + 1;

if ($currentPage > 1) {
    echo "<a href='?page=$previousPage'>&laquo; Previous</a>";
}

for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $currentPage) {
        echo "<a class='active' href='?page=$i'>$i</a>";
    } else {
        echo "<a href='?page=$i'>$i</a>";
    }
}

if ($currentPage < $totalPages) {
    echo "<a href='?page=$nextPage'>Next &raquo;</a>";
}

echo "</div>";
} else {
  echo "no orders.";
  }
  

  $conn->close();
  ?>





<?php
require_once 'footer_qladmin.php';
?>