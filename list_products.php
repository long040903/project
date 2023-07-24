<?php
require_once 'header_qladmin.php';
?>


<div class="box-products">
				<div class="head-title">
					<div class="left">
                        <div class="box-add">
                            <div class="add">
                                <a href="../Source/ADMIN/index.php">add</a>
                            </div>
                            <h1>list products</h1>
                        </div>
						
						<?php 


							
							$records_per_page = 10;

							if (isset($_GET['page']) && is_numeric($_GET['page'])) {
								$current_page = (int) $_GET['page'];
							} else {
								$current_page = 1;
							}

						
							$offset = ($current_page - 1) * $records_per_page;

							
							$result = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM product");


							$row = mysqli_fetch_assoc($result);
							$total_records = $row['total_records'];

				
							$total_pages = ceil($total_records / $records_per_page);

					
							$sql = "SELECT * FROM product LIMIT $offset, $records_per_page";
							$result = mysqli_query($conn, $sql);

				
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
								echo "<div class='name-out' >" . $row['name'] . "</div>";
								echo "<div class='price-out'>" . $row['price'] . "</div>";
								echo "<div class='image'><img  src='ADMIN/uploads/" . $row['img'] . "' alt=''></div>";

								echo "<div class='button'>";
								echo "<a href='ADMIN/edit.php' style='background: #FFCE26;margin-right: 5px;border-radius: 5px;'>edit</a>";
								echo "<a href='ADMIN/deleteprd.php' style='background: #ff0b00;border-radius: 5px;'>delete</a>";
								echo "</div>";
								echo "</div>";
							}

							echo "</div>";

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