<?php
require_once 'connect.php';
session_start();
if (!isset($_SESSION['loginAdmin'])) {
  header('Location: ../Source/loginAdmin.php');

}
$user_id = $_SESSION['loginAdmin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../Source/css/qladmin.css">

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
				<a href="list_categorys.php" id="categorys">
					<i class='bx bxs-shopping-bag-alt'  ></i>
					<span class="text">categorys</span>
				</a>
			</li>
			<li>
				<a href="list_products.php" id="products">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">products</span>
				</a>
			</li>
			<li>
				<a href="list_users.php" id="users">
					<i class='bx bxs-user' ></i>
					<span class="text">users</span>
				</a>
			</li>
			<li>
				<a href="list_message.php" id="message">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="order.php">
					<i class='bx bxl-shopify' ></i>
					<span class="text">order</span>
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
				<a href="logoutAdmin.php" class="logout">
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
			
			
		</nav>
		<main>