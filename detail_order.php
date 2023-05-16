

<?php
require_once "connect.php";


$countSql = "SELECT COUNT(*) AS total FROM `order`  INNER JOIN user ON `order`.`userId`= user.id ";
$countResult = $conn->query($countSql);
$totalItems = $countResult->fetch_assoc()['total'];


$itemsPerPage = 5;


$totalPages = ceil($totalItems / $itemsPerPage);


$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;


$start = ($currentPage - 1) * $itemsPerPage;
$sql = "SELECT user.username,user.phone,user.address, `order`.quantity,`order`.totalPrice FROM `order`  INNER JOIN user ON `order`.`userId`= user.id 
        LIMIT $start, $itemsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
      echo "<td>" . $row["phone"] . "</td>";
      echo "<td>" . $row["address"] . "</td>";
      echo "<td>" . $row["quantity"] . "</td>";
      echo "<td>" . $row["totalPrice"] . "</td>";

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
  echo "Không có đơn hàng.";
  }
  

  $conn->close();
  ?>
  

