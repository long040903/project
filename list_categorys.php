<?php
require_once 'header_qladmin.php';


?>

<div class="box-categorys">
				<div class="head-title">
					<div class="left">
                        <div class="box-add">
                            <div class="add">
                                <a href="../Source/ADMIN/addcate.php">add</a>
                            </div>
                            <h1>list category</h1>
                        </div>
						
							<div class="box">
									<div class="table">
										<div class="no">No.</div>
										<div class="name">Name category</div>
										<div class="action">Action</div>
									</div>
								<?php
									if (isset($_POST['name'])) {
										$name_cl = $_POST['name'];

										$sql = "INSERT INTO cate(name) VALUES ('$name_cl')";
										$res = $conn->query($sql);
										if ($res) {
											echo "added successfully";
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
													
													<a style="background: #ff0b00;border-radius: 5px;" href="./ADMIN/deletecate.php?id=<?php echo $collection['id']; ?>" class="btn btn-danger" id="btn-xoa">Delete</a>
												</div>
											</div>
										<?php
										endforeach;
										?>
							</div>
						
					</div>
				</div>
			</div>




<?php
    require_once 'footer_qladmin.php';
?>