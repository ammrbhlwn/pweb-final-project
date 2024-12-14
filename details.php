<?php
include("function/session.php");
include("db/dbconn.php");
include("function/cash.php");
include("function/paypal.php");
?>
<!DOCTYPE html>
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


	<main>
		<div id="container">
			<?php
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$query = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$id' ");
				$row = mysqli_fetch_array($query);
			?>
				<div>
					<center>
						<img class="img-polaroid" style="width:400px; height:350px;" src="photo/<?php echo $row['product_image']; ?>">
						<h2 class="text-uppercase bg-primary"><?php echo $row['product_name'] ?></h2>
						<h3 class="text-uppercase">Rp <?php echo $row['product_price'] ?></h3>
						<h3 class="text-uppercase">Size: <?php echo $row['product_size'] ?></h3>
						<?php echo "<a href='cart.php?id=" . $id . "&action=add'><input type='submit' class='btn btn-inverse' name='add' value='Add to Cart'></a> &nbsp;  <a href='product.php'><button class='btn btn-inverse'>Back</button></a> " ?>
					</center>
				</div>
			<?php } ?>

			<div id="purchase" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Mode Of Payment</h3>
				</div>
				<div class="modal-body">
					<form method="post">
						<center>
							<input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
							<input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
							<input type="hidden" value="<?php echo $fetch['firstname']; ?>&nbsp;<?php echo $fetch['lastname']; ?>" name="customer">
							<textarea name="destination" placeholder="Destination" style="height:100px; width:250px;" required></textarea>
							<select name="size" required style="width:150px;">
								<option value="">---------Size----------</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
							<br />
							<h4>Total: Rp <?php echo $row['product_price']; ?> </h4>
							<br />
							<input type="checkbox" required> I Agree the <a href="#terms" data-toggle="modal"> Terms and Condition</a> of Footwearin. Inc.
						</center>
				</div>
				<div class="modal-footer">
					<center>
						<input type="image" src="images/button.jpg" border="0" name="paypal" alt="Make payments with PayPal - it's fast, free and secure!" />
						<input type="submit" name="cash" value="Cash" class="btn btn-lg">
					</center>
					<button class="btn btn-danger btn-mini" data-dismiss="modal" aria-hidden="true">Cancel</button>
					</form>
				</div>
			</div>

			<div id="terms" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Footwearin. Inc. Terms and Condition</h3>
				</div>
				<div class="modal-body">
					<ul>
						<li>You are guaranteed that your product will be deliver 2-3 days upon ordering.</li>
						<li>Guaranteed time maybe suspended depending on the weather conditions for the safety of our delivery personnel.</li>
						<li>All prices quoted are in Philippine pesos. Price and availability information is subject to change without notice.</li>
						<li>Mode of payment are as follows:customers with paypal account can pay through paypal otherwise Cash on Delivery(COD).</li>
						<li>Upon receiving your product we will charge for delivering for only 150 pesos, depending on the location.</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>
		</div>
	</main>

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