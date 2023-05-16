<?php
require_once 'header_qladmin.php';
?>




<div class="box-message">
				<div class="head-title">
					<div class="left">
						<h1>list contact</h1>
						
						
							<?php

								
							$records_per_page = 10;

							if (isset($_GET['page']) && is_numeric($_GET['page'])) {
								$current_page = (int) $_GET['page'];
							} else {
								$current_page = 1;
							}

						
							$offset = ($current_page - 1) * $records_per_page;

					
							$result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM contact");


						
							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total_records'];

					
							$total_pages = ceil($total_records / $records_per_page);

						
							$sql = "SELECT * FROM contact LIMIT $offset, $records_per_page";
							$result = mysqli_query($conn, $sql);
					
							$sql = "SELECT * FROM contact";
							$result = $conn->query($sql);
							?>
							
							<div class="box">
								<div class="table">
									<div class="name">Name</div>
									<div class="email">Email</div>
									<div class="phone">Phone</div>
									<div class="message">Message</div>
								</div>
								<?php foreach ($result as $row): ?>
								<div class="table-out">
									<div class="name-out"><?php echo $row["username"]; ?></div>
									<div class="email-out"><?php echo $row["email"]; ?></div>
									<div class="phone-out"><?php echo $row["phone"]; ?></div>
									<div class="message-out"><?php echo $row["message"]; ?></div>
								</div>
								<?php endforeach; ?>
								</div>
							
							<?php
				
							$conn->close();

			
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