<?php
ob_start();
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

	<!--Le Facebox-->
	<link href="../facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="../facefiles/jquery-1.9.js" type="text/javascript"></script>
	<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
	<script src="../facefiles/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('a[rel*=facebox]').facebox()
		})
	</script>
</head>

<body>
	<div id="add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Add Product...</h3>
		</div>
		<div class="modal-body">
			<form method="post" enctype="multipart/form-data">
				<center>
					<table>
						<tr>
							<td><input type="file" name="product_image" required></td>
						</tr>
						<?php include("random_id.php");
						echo '<tr>
								<td><input type="hidden" name="product_code" value="' . $code . '" required></td>
							<tr/>';
						?>
						<tr>
							<td><input type="text" name="product_name" placeholder="Product Name" style="width:250px;" required></td>
							<tr />
						<tr>
							<td><input type="text" name="product_price" placeholder="Price" style="width:250px;" required></td>
						</tr>
						<tr>
							<td><input type="text" name="product_size" placeholder="Size" style="width:250px;" maxLength="2" required></td>
						</tr>
						<tr>
							<td><input type="text" name="brand" placeholder="Brand Name	" style="width:250px;" required></td>
						</tr>
						<tr>
							<td><input type="number" name="qty" placeholder="No. of Stock" style="width:250px;" required></td>
						</tr>
						<tr>
							<td><input type="hidden" name="category" value="feature"></td>
						</tr>
					</table>
				</center>
		</div>
		<div class="modal-footer">
			<input class="btn btn-primary" type="submit" name="add" value="Add">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
			</form>
		</div>
	</div>

	<?php
	if (isset($_POST['add'])) {
		$product_code = $_POST['product_code'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_size = $_POST['product_size'];
		$brand = $_POST['brand'];
		$category = $_POST['category'];
		$qty = $_POST['qty'];
		$code = rand(0, 98987787866533499);

		$name = $code . $_FILES["product_image"]["name"];
		$type = $_FILES["product_image"]["type"];
		$size = $_FILES["product_image"]["size"];
		$temp = $_FILES["product_image"]["tmp_name"];
		$error = $_FILES["product_image"]["error"];

		if ($error > 0) {
			die("Error uploading file! Code $error.");
		} else {
			if ($size > 30000000000) //conditions for the file
			{
				die("Format is not allowed or file size is too big!");
			} else {
				move_uploaded_file($temp, "../photo/" . $name);


				$q1 = mysqli_query($conn, "INSERT INTO product ( product_id,product_name, product_price, product_size, product_image, brand, category)
				VALUES ('$product_code','$product_name','$product_price','$product_size','$name', '$brand', '$category')");

				$q2 = mysqli_query($conn, "INSERT INTO stock ( product_id, qty) VALUES ('$product_code','$qty')");

				exit(header("location:admin_feature.php"));
			}
		}
	}

	?>

	<section class="product-container">
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
		<div class="content-dashboard">
			<div class="title-container">
				<h2>Features</h2>
				<div class="search-add">
					<label><input type="text" name="filter" placeholder="Search Product here..." id="filter"></label>
					<a href="#add" role="button" class="btn-add" data-toggle="modal"><i class="icon-plus-sign icon-white"></i>Add Product</a>
				</div>
			</div>
			<div class="table-container">
				<table class="table-content">
					<thead>
						<tr>
							<th>Product Image</th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Product Sizes</th>
							<th>No. of Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query = mysqli_query($conn, "SELECT * FROM `product` WHERE category='feature' ORDER BY product_id DESC");
						while ($fetch = mysqli_fetch_array($query)) {
							$id = $fetch['product_id'];
						?>
							<tr class="del<?php echo $id ?>">
								<td><img class="img-polaroid" src="../photo/<?php echo $fetch['product_image'] ?>" height="70px" width="80px"></td>
								<td><?php echo $fetch['product_name'] ?></td>
								<td><?php echo $fetch['product_price'] ?></td>
								<td><?php echo $fetch['product_size'] ?></td>

								<?php
								$query1 = mysqli_query($conn, "SELECT * FROM `stock` WHERE product_id='$id'");
								$fetch1 = mysqli_fetch_array($query1);

								$qty = $fetch1['qty'];
								?>

								<td><?php echo $fetch1['qty'] ?></td>
								<td>
									<?php
									echo "<a href='stockin.php?id=" . $id . "' class='btn btn-success' rel='facebox'><i class='icon-plus-sign icon-white'></i> Stock In</a> ";
									echo "<a href='stockout.php?id=" . $id . "' class='btn btn-danger' rel='facebox'><i class='icon-minus-sign icon-white'></i> Stock Out</a>";
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<?php
	if (isset($_POST['stockin'])) {

		$pid = $_POST['pid'];

		$result = mysqli_query($conn, "SELECT * FROM `stock` WHERE product_id='$pid'");
		$row = mysqli_fetch_array($result);

		$old_stck = $row['qty'];
		$new_stck = $_POST['new_stck'];
		$total = $old_stck + $new_stck;

		$que = mysqli_query($conn, "UPDATE `stock` SET `qty` = '$total' WHERE `product_id`='$pid'");

		header("Location:admin_feature.php");
	}

	if (isset($_POST['stockout'])) {

		$pid = $_POST['pid'];

		$result = mysqli_query($conn, "SELECT * FROM `stock` WHERE product_id='$pid'");
		$row = mysqli_fetch_array($result);

		$old_stck = $row['qty'];
		$new_stck = $_POST['new_stck'];
		$total = $old_stck - $new_stck;

		$que = mysqli_query($conn, "UPDATE `stock` SET `qty` = '$total' WHERE `product_id`='$pid'");

		if ($total <= 0) {

			$que = mysqli_query($conn, "DELETE FROM `stock` WHERE `product_id` = '$pid'");
			$que = mysqli_query($conn, "DELETE FROM `product` WHERE `product_id` = '$pid'");
		} else {

			$que = mysqli_query($conn, "UPDATE `stock` SET `qty` = '$total' WHERE `product_id`='$pid'");
		}

		header("Location:admin_feature.php");
	}
	?>

</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {

		$('.remove').click(function() {

			var id = $(this).attr("id");


			if (confirm("Are you sure you want to delete this product?")) {


				$.ajax({
					type: "POST",
					url: "../function/remove.php",
					data: ({
						id: id
					}),
					cache: false,
					success: function(html) {
						$(".del" + id).fadeOut(2000, function() {
							$(this).remove();
						});
					}
				});
			} else {
				return false;
			}
		});
	});
</script>