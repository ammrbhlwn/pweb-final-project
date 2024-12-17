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
	<script language="javascript" type="text/javascript">
		function printFunc(divID) {
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
				<h2>Orders</h2>
				<div class="search-add">
					<label><input type="text" name="filter" placeholder="Search Orders here..." id="filter"></label>
				</div>
			</div>
			<div class="table-container">
				<table class="table-content">
					<thead>
						<tr>
							<th style="font-size:1.2rem; width:100%">Product</th>
							<th style="font-size:1.2rem; width:100%">Transaction No.</th>
							<th style="font-size:1.2rem; width:100%">Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$Q1 = mysqli_query($conn, "SELECT * FROM transaction WHERE order_stat = 'Confirmed'");
						while ($r1 = mysqli_fetch_array($Q1)) {

							$tid = $r1['transaction_id'];

							$Q2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN product ON product.product_id = transaction_detail.product_id WHERE transaction_detail.transaction_id = '$tid' ");
							$r2 = mysqli_fetch_array($Q2);

							$pid = $r2['product_id'];
							$o_qty = $r2['order_qty'];

							$p_price = $r2['product_price'];
							$brand = $r2['product_name'];

							echo "<tr>";
							echo "<td style='text-align: center; align-self: center; width: 174px;'>" . $brand . "</td>";
							echo "<td style='text-align: center; align-self: center; width: 174px;'>" . $tid . "</td>";
							echo "<td style='text-align: center; align-self: center; width: 174px;'>" . formatMoney($p_price * $o_qty) . "</td>";
							echo "</tr>";
						}

						$Q3 = mysqli_query($conn, "SELECT sum(amount) FROM transaction WHERE order_stat = 'Confirmed'");
						while ($r3 = mysqli_fetch_array($Q3)) {

							$amnt = $r3['sum(amount)'];
							echo "<tr><td></td><td>TOTAL : </td> <td><b>Rp " . formatMoney($amnt) . "</b></td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<?php
	function formatMoney($number, $fractional = false)
	{
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else {
				break;
			}
		}
		return $number;
	}
	?>
</body>

</html>