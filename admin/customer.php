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
	<script src="../js/jquery-1.7.2.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../javascripts/filter.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
	<section class="product-container">
		<div class="sidebar-container">
			<div class="sidebar">
				<li><a href="admin_home.php">Dashboard</a></li>
				<li><a href="admin_home.php">Products</a>
					<ul>
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
		<div class="content-dashboard">
			<div class="title-container">
				<h2>Customers</h2>
				<div class="search-add">
					<label><input type="text" name="filter" placeholder="Search Customers here..." id="filter"></label>
				</div>
			</div>
			<div class="table-container">
				<table class="table-content">
					<thead>
						<tr>
							<th style="font-size:1.2rem; width:100%">Name</th>
							<th style="font-size:1.2rem; width:100%">Address</th>
							<th style="font-size:1.2rem; width:100%">Zipcode</th>
							<th style="font-size:1.2rem; width:100%">Telephone</th>
							<th style="font-size:1.2rem; width:100%">Email</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = mysqli_query($conn, "SELECT * FROM `customer`");
						while ($fetch = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['name']; ?></td>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['address'] ?></td>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['country'] ?></td>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['zipcode'] ?></td>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['telephone'] ?></td>
								<td style="text-align: center; align-self:center; width:174px"><?php echo $fetch['email'] ?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</body>

</html>