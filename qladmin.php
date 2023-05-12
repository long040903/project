<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="qladmin.css">

	<title>AdminHub</title>
</head>

<body>
	
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			
			
			<li>
				<a href="#" id="categorys">
					<i class='bx bxs-shopping-bag-alt'  ></i>
					<span class="text">categorys</span>
				</a>
			</li>
			<li>
				<a href="#" id="products">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">products</span>
				</a>
			</li>
			<li>
				<a href="#" id="users">
					<i class='bx bxs-user' ></i>
					<span class="text">users</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<main>
			
			<div class="box-users">
				<div class="head-title">
					<div class="left">
						<h1>list users</h1>
						<?php 


							require_once "connect.php";





							// Xác định số bản ghi trên mỗi trang
							$records_per_page = 10;

							// Xác định trang hiện tại
							if (isset($_GET['page']) && is_numeric($_GET['page'])) {
								$current_page = (int) $_GET['page'];
							} else {
								$current_page = 1;
							}

							// Tính toán số bản ghi bắt đầu và kết thúc của trang hiện tại
							$offset = ($current_page -1) * $records_per_page;

							// Thực hiện câu truy vấn đếm tổng số bản ghi
							$result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM user");


							// Lấy kết quả đếm tổng số bản ghi
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total_records'];

							// Tính toán số trang
							$total_pages = ceil($total_records / $records_per_page);

							// Thực hiện câu truy vấn lấy bản ghi cho trang hiện tại
							$sql = "SELECT * FROM user LIMIT $offset, $records_per_page";
							$result = mysqli_query($conn, $sql);

							// Hiển thị danh sách bản ghi



							




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
									echo "<a style='background: #6db6ff;border-radius: 5px;' '>admin</a>";
									echo "</td>";
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
					</div>
				</div>
			</div>

			<div class="box-products">
				<div class="head-title">
					<div class="left">
						<h1>list products</h1>
						<?php 

							require_once "connect.php";


							// Xác định số bản ghi trên mỗi trang
							$records_per_page = 10;

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
							echo "<div class='table'>";
							echo "<div class='tr'>";
							echo "<div class='avatar'>Avatar</div>";
							echo "<div class='name'>Name</div>";
							echo "<div class='price' >price</div>";
							echo "<div class='action' >Action</div>";
							echo "</div>";

							while ($row = mysqli_fetch_assoc($result)) {
								echo "<div class='tr'>";
								echo "<div class='image'><img  src='ADMIN/uploads/" . $row['img'] . "' alt=''></div>";
								echo "<div class='name-out' >" . $row['name'] . "</div>";
								echo "<div class='price-out'>" . $row['price'] . "</div>";
								echo "<div class='button'>";
								echo "<a href='ADMIN/edit.php' style='background: #FFCE26;margin-right: 5px;border-radius: 5px;'>edit</a>";
								echo "<a href='ADMIN/deleteprd.php' style='background: #ff0b00;border-radius: 5px;'>delete</a>";
								echo "</div>";
								echo "</div>";
							}

							echo "</div>";

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

					</div>
				</div>
			</div>

			<div class="box-categorys">
				<div class="head-title">
					<div class="left">
						<h1>list category</h1>
							<div class="box">
									<div class="table">
										<div class="no">No.</div>
										<div class="name">Name category</div>
										<div class="action">Action</div>
									</div>
								<?php
									require_once 'connect.php';
									if (isset($_POST['name'])) {
										$name_cl = $_POST['name'];

										$sql = "INSERT INTO cate(name) VALUES ('$name_cl')";
										$res = $conn->query($sql);
										if ($res) {
											echo "thêm thành công";
										}
									}

									$sql = "SELECT * FROM cate";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										$lst_collection = $result->fetch_all(MYSQLI_ASSOC);
									} else {
										$lst_collection = [];
									}

									
										$i = 0;
										foreach ($lst_collection as $collection) :
											$i++;
										
										?>
											

											<div class="table-out">
												<div class="no-out"><?php echo $i ?></div>
												<div class="name-out"><?php echo $collection['name'] ?></div>
												<div class="action-out">
													<a style="margin-right: 10px;background: #FFCE26;border-radius: 5px;" href="updateprd.php?id=<?php echo $prd['id']; ?>" class="btn btn-warning me-2">Update</a>
													<a style="background: #ff0b00;border-radius: 5px;" href="deletecate.php?id=<?php echo $collection['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
												</div>
											</div>
										<?php
										endforeach;
										?>
							</div>
						
					</div>
				</div>
			</div>
			
		</main>
	</section>
	





























	<script>
		const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

		allSideMenu.forEach(item=> {
			const li = item.parentElement;

			item.addEventListener('click', function () {
				allSideMenu.forEach(i=> {
					i.parentElement.classList.remove('active');
				})
				li.classList.add('active');
			})
		});


		let users = document.querySelector('.box-users');
		let products = document.querySelector('.box-products');
		let categorys = document.querySelector('.box-categorys');


		

		document.querySelector('#users').onclick = () =>{
			users.classList.toggle('active');
			products.classList.remove("active");
			categorys.classList.remove('active');
		}

		document.querySelector('#categorys').onclick = () =>{
			categorys.classList.toggle('active');
			products.classList.remove('active');
			users.classList.remove('active');
			
		}

		document.querySelector('#products').onclick = () =>{
			products.classList.toggle('active');
			users.classList.remove('active');
			categorys.classList.remove('active');
		}


		window.onscroll = () =>{
			users.classList.remove('active');
			products.classList.remove("active");
			categorys.classList.remove('active');
		}


		// TOGGLE SIDEBAR
		const menuBar = document.querySelector('#content nav .bx.bx-menu');
		const sidebar = document.getElementById('sidebar');

		menuBar.addEventListener('click', function () {
			sidebar.classList.toggle('hide');
		})
	</script>
</body>
</html>