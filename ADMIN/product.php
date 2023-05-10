<?php 

require_once "../connect.php";


// Xác định số bản ghi trên mỗi trang
$records_per_page = 4;

// Xác định trang hiện tại
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Tính toán số bản ghi bắt đầu và kết thúc của trang hiện tại
$offset = ($current_page - 1) * $records_per_page;

// Thực hiện câu truy vấn đếm tổng số bản ghi
$result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM product");


// Lấy kết quả đếm tổng số bản ghi
$row = mysqli_fetch_assoc($result);
$total_records = $row['total_records'];

// Tính toán số trang
$total_pages = ceil($total_records / $records_per_page);

// Thực hiện câu truy vấn lấy bản ghi cho trang hiện tại
$sql = "SELECT * FROM product LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);

// Hiển thị danh sách bản ghi
while ($row = mysqli_fetch_assoc($result)) {
  echo "<table>";
echo "<tr>";
echo "<th>Avatar</th>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td><img src='../ADMIN/uploads/" . $row['img'] . "' alt='Ảnh sản phẩm'></td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "</tr>";
}

echo "</table>";

}



// Hiển thị phân trang
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
