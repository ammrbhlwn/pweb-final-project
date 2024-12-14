<?php
include("../function/session.php");
include("../db/dbconn.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Footwearin.</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>

<body>
	<section class="admin-container">
		<div class="sidebar-container">
			<div class="sidebar">
				<li><a href="admin_home.php">Dashboard</a></li>
				<li><a href="admin_home.php">Products</a>
					<ul>
						<li><a href="admin_feature.php ">Features</a></li>
						<li><a href="admin_product.php ">Basketball</a></li>
						<li><a href="admin_football.php">Football</a></li>
						<li><a href="admin_running.php">Running</a></li>
					</ul>
				</li>
				<li><a href="transaction.php">Transactions</a></li>
				<li><a href="customer.php">Customers</a></li>
				<li><a href="order.php">Orders</a></li>
			</div>
		</div>
		<div class="content-home">
			<h1>Selamat Datang!</h1>
		</div>
	</section>
</body>

</html>