<?php
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id = 'yhannaki@gmail.com'; // Business email ID
?>
<?php
include("function/session.php");
include("db/dbconn.php");
?>
<html>

<head>
	<title>Footwearin.</title>
	<link rel="icon" href="img/logoFootwearin.png" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>

	<header>
		<nav class="navbar">
			<a href="index.php" class="logo-container">
				<img src="img/logoFootwearin.png" alt="Footwearin Logo">
				<p>Footwearin.</p>
			</a>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="aboutus.php">About</a></li>
				<li><a href="product.php">Product</a></li>
			</ul>
			<div class="auth-container">
				<?php if (isset($_SESSION['id'])) {
					$id = (int) $_SESSION['id'];
					$query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id'");
					$fetch = mysqli_fetch_array($query);
				?>
					<ul>
						<li><a href="function/logout.php">Logout</a></li>
						<li><a href="#profile" data-toggle="modal"><?php echo $fetch['firstname'] . " " . $fetch['lastname']; ?></a></li>
					</ul>
				<?php } else { ?>
					<a href="#login" data-toggle="modal" class="btn-auth">Login</a>
					<a href="#signup" data-toggle="modal" class="btn-auth">Sign Up</a>
				<?php } ?>
			</div>
		</nav>
	</header>

	<div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">My Account</h3>
		</div>
		<div class="modal-body">
			<?php
			$id = (int) $_SESSION['id'];

			$query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ");
			$fetch = mysqli_fetch_array($query);
			?>
			<center>
				<form method="post">
					<center>
						<table>
							<tr>
								<td class="profile">Name:</td>
								<td class="profile"><?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['mi']; ?>&nbsp;<?php echo $fetch['lastname']; ?></td>
							</tr>
							<tr>
								<td class="profile">Address:</td>
								<td class="profile"><?php echo $fetch['address']; ?></td>
							</tr>
							<tr>
								<td class="profile">Country:</td>
								<td class="profile"><?php echo $fetch['country']; ?></td>
							</tr>
							<tr>
								<td class="profile">ZIP Code:</td>
								<td class="profile"><?php echo $fetch['zipcode']; ?></td>
							</tr>
							<tr>
								<td class="profile">Mobile Number:</td>
								<td class="profile"><?php echo $fetch['mobile']; ?></td>
							</tr>
							<tr>
								<td class="profile">Telephone Number:</td>
								<td class="profile"><?php echo $fetch['telephone']; ?></td>
							</tr>
							<tr>
								<td class="profile">Email:</td>
								<td class="profile"><?php echo $fetch['email']; ?></td>
							</tr>
						</table>
					</center>
		</div>
		<div class="modal-footer">
			<a href="account.php?id=<?php echo $fetch['customerid']; ?>"><input type="button" class="btn btn-success" name="edit" value="Edit Account"></a>
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
		</form>
	</div>



	<br>
	<div id="container">
		<form method="post" class="well" style="background-color:#fff; overflow:hidden;">
			<table class="table" style="width:50%;">
				<label style="font-size:25px;">Summary of Order/s</label>
				<tr>
					<th>
						<h5>Quantity</h5>
						</td>
					<th>
						<h5>Product Name</h5>
						</td>
					<th>
						<h5>Size</h5>
						</td>
					<th>
						<h5>Price</h5>
						</td>
				</tr>

				<?php
				$t_id = $_GET['tid'];
				$query = mysqli_query($conn, "SELECT * FROM transaction WHERE transaction_id = '$t_id'");
				$fetch = mysqli_fetch_array($query);

				$amnt = $fetch['amount'];
				$t_id = $fetch['transaction_id'];

				$query2 = mysqli_query($conn, "SELECT * FROM transaction_detail LEFT JOIN product ON product.product_id = transaction_detail.product_id WHERE transaction_detail.transaction_id = '$t_id'");
				while ($row = mysqli_fetch_array($query2)) {

					$pname = $row['product_name'];
					$psize = $row['product_size'];
					$pprice = $row['product_price'];
					$oqty = $row['order_qty'];

					echo "<tr>";
					echo "<td>" . $oqty . "</td>";
					echo "<td>" . $pname . "</td>";
					echo "<td>" . $psize . "</td>";
					echo "<td>" . $pprice . "</td>";
					echo "</tr>";
				}
				?>

			</table>
			<legend></legend>
			<h4>TOTAL: Rp <?php echo $amnt; ?></h4>
		</form>
		<div class='pull-right'>
			<div class="">
				<form action="<?php echo $paypal_url ?>" method="post">

					<input type="hidden" name="cancel_return" value="function/cancel.php">
					<input type="hidden" name="return" value="function/success.php">
					<img src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				</form>
			</div>
		</div>


		<div id="purchase" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Mode Of Payment</h3>
			</div>
			<div class="modal-body">
				<form method="post">
					<center>
						<input type="image" src="images/button.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
						<br />
						<br />
						<button class="btn btn-lg">Cash</button>
					</center>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
				</form>
			</div>
		</div>
	</div>
	<footer>
		<div class="footer-container">
			<a href="index.php" class="logo-container">
				<img src="img/logoFootwearin.png" alt="Footwearin Logo">
				<p>&copy;2024 Footwearin. </p>
			</a>
			<div class="link-footer">
				<div class="quick-links">
					<h1>Quick Links</h1>
					<a href="index.php">Home</a>
					<a href="aboutus.php">About</a>
					<a href="product.php">Product</a>
					<a href="index.php">Login</a>
				</div>
				<div class="quick-links">
					<h1>Social Media</h1>
					<a href="#">Instagram</a>
					<a href="#">X</a>
					<a href="#">Facebook</a>
					<a href="#">Youtube</a>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>