<?php
require_once "../connect.php";






$records_per_page = 4;


if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

$offset = ($current_page -1) * $records_per_page;


$result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM user");



$row = mysqli_fetch_assoc($result);
$total_records = $row['total_records'];


$total_pages = ceil($total_records / $records_per_page);


$sql = "SELECT * FROM user LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);






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
  <?php 
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<table>";
  echo "<tr>";
  echo "<th>Name</th>";
  echo "<th>Email</th>";
  echo "</tr>";
  
  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "</tr>";
  }
  
  echo "</table>";
  
  }
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
</body>
</html>