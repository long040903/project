<?php
require_once 'header_qladmin.php';
if (isset($_POST['admin'])) {
  $username = $_POST['username'];
  $sql = "UPDATE user SET isAdmin='true' WHERE username = '$username'";
  $res = $conn->query($sql);
  if ($res) {
      echo "Đã chỉ định $username thành admin.";
  } else {
      echo "Không thành công.";
  }
}

?>

<div class="box-users">
				<div class="head-title">
					<div class="left">
						<h1>list users</h1>
						<?php 
							
							$records_per_page = 10;

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

						
							$sql = "SELECT * FROM user WHERE isAdmin  is NULL LIMIT $offset, $records_per_page";
							$result = mysqli_query($conn, $sql);

							
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<table>";
								echo "<tr class='navbar'>";
								echo "<th class='name'>Name</th>";
								echo "<th>Email</th>";
								echo "<th>Action</th>";
								echo "</tr>";

								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>" . $row['username'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>";
                  echo '<form style="background: #6db6ff; border-radius: 5px; " method = "post" >
                  <input type="hidden" name="username" value="'.$row['username'].'">
                  <input type="submit"  name = "admin" value="Admin">   
                   </form>';
									echo "</td>";
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
					</div>
				</div>
			</div>



<?php
require_once 'footer_qladmin.php';
?>