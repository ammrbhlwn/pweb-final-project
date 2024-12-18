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
							<td><input type="hidden" name="category" value="basketball"></td>
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

				header("location:admin_product.php");
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
				<h2>Transaction</h2>
				<div class="search-add">
					<label><input type="text" name="filter" placeholder="Search Transactions here..." id="filter"></label>
				</div>
			</div>
			<div class="table-container">
				<table class="table-content">
					<thead>
						<tr>
							<th style="font-size:1.2rem; width: 45px">ID</th>
							<th style="font-size:1.2rem; width: 100px">Date</th>
							<th style="font-size:1.2rem">Customer Name</th>
							<th style="font-size:1.2rem">Total Order</th>
							<th style="font-size:1.2rem">Order Status</th>
							<th style="width: 213px; text-align:center; font-size:1.2rem;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query = mysqli_query($conn, "SELECT * FROM transaction LEFT JOIN customer ON customer.customerid = transaction.customerid");
						while ($fetch = mysqli_fetch_array($query)) {
							$id = $fetch['transaction_id'];
							$amnt = $fetch['amount'];
							$o_stat = $fetch['order_stat'];
							$o_date = $fetch['order_date'];

							$name = $fetch['name'];
						?>
							<tr>
								<td style="width: 45px; text-align: center; align-self:center"><?php echo $id; ?></td>
								<td style="width: 100px; text-align: center; align-self:center"><?php echo $o_date; ?></td>
								<td style="width: 164.5px; text-align: center; align-self:center"><?php echo $name; ?></td>
								<td style="width: 113px; text-align: center; align-self:center"><?php echo $amnt; ?></td>
								<td style="width: 127px; text-align: center; align-self:center"><?php echo $o_stat; ?></td>
								<td style="width: 213px; text-align: center; align-self:center"><a href="receipt.php?tid=<?php echo $id; ?>">View</a>
									<?php
									if ($o_stat == 'Confirmed') {
									} elseif ($o_stat == 'Cancelled') {
									} else {
										echo '| <a class="btn-in" href="confirm.php?id=' . $id . '">Confirm</a> ';
										echo '| <a class="btn-out" href="cancel.php?id=' . $id . '">Cancel</a></td>';
									}
									?>
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

		header("Location:admin_product.php");
	}

	if (isset($_POST['stockout'])) {

		$pid = $_POST['pid'];

		$result = mysqli_query($conn, "SELECT * FROM `stock` WHERE product_id='$pid'");
		$row = mysqli_fetch_array($result);

		$old_stck = $row['qty'];
		$new_stck = $_POST['new_stck'];
		$total = $old_stck - $new_stck;

		if ($total <= 0) {

			$que = mysqli_query($conn, "DELETE FROM `stock` WHERE `product_id` = '$pid'");
			$que = mysqli_query($conn, "DELETE FROM `product` WHERE `product_id` = '$pid'");
		} else {

			$que = mysqli_query($conn, "UPDATE `stock` SET `qty` = '$total' WHERE `product_id`='$pid'");
		}

		header("Location:admin_product.php");
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