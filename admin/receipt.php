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

	<link href="../facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="../facefiles/jquery-1.9.js" type="text/javascript"></script>
	<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
	<script src="../facefiles/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('a[rel*=facebox]').facebox()
		})
	</script>

	<script language="javascript" type="text/javascript">
		function printDiv(divID) {
			var divElements = document.getElementById(divID).innerHTML;
			var oldPage = document.body.innerHTML;

			document.body.innerHTML =
				"<html><head><title></title></head><body>" +
				divElements + "</body>";
			window.print();
			document.body.innerHTML = oldPage;
		}
	</script>
</head>

<body>
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
			<?php
			$t_id = $_GET['tid'];
			$query = mysqli_query($conn, "SELECT * FROM transaction WHERE transaction_id = '$t_id'");
			$fetch = mysqli_fetch_array($query);

			$amnt = $fetch['amount'];
			?>
			<div class="title-container">
				<h2>Invoice</h2>
				<h3>Footwearin. Inc.</h3>
			</div>
			<?php
			echo "Date : " . $fetch['order_date'] . "";
			?>
			<div id="printablediv" class="table-container">
				<table class="table-content">
					<thead>
						<tr>
							<th style="font-size:1.2rem;">Product</th>
							<th style="font-size:1.2rem">Size</th>
							<th style="font-size:1.2rem;">Quanity</th>
							<th style="font-size:1.2rem">Price</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN product ON product.product_id = transaction_detail.product_id WHERE transaction_detail.transaction_id = '$t_id'");
						while ($row = mysqli_fetch_array($query2)) {

							$pname = $row['product_name'];
							$psize = $row['product_size'];
							$pprice = $row['product_price'];
							$oqty = $row['order_qty'];

							echo "<tr>";
							echo "<td>" . $pname . "</td>";
							echo "<td>" . $psize . "</td>";
							echo "<td>" . $oqty . "</td>";
							echo "<td>" . $pprice . "</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td colspan='4' style='text-align:right; width:100%'><h4>TOTAL: Rp " . $amnt . "</h4></td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="print"><a onclick="javascript:printDiv('printablediv')" name="print" style="cursor:pointer;" class="btn-print"><i class="icon-white icon-print"></i> Print Receipt</a></div>
		</div>
	</section>
</body>

</html>