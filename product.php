<?php
session_start();
include("db/dbconn.php");
include("function/login.php");
include("function/customer_signup.php");
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

	<div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:400px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Login...</h3>
		</div>
		<div class="modal-body">
			<form method="post">
				<center>
					<input type="email" name="email" placeholder="Email" style="width:250px;">
					<input type="password" name="password" placeholder="Password" style="width:250px;">
				</center>
				<div class="modal-footer">
					<input class="btn btn-primary" type="submit" name="login" value="Login">
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</form>
		</div>
	</div>

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
					<div class="modal-footer">
						<a href="account.php?id=<?php echo $fetch['customerid']; ?>"><input type="button" class="btn btn-success" name="edit" value="Edit Account"></a>
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
				</form>
			</center>
		</div>
	</div>

	<main>
		<div class="nav-category">
			<form method="post">
				<?php
				include('function/addcart.php');
				?>
				<ul class="nav-list">
					<li><a href="product.php" class="active">Basketball</a></li>
					<li><a href="football.php">Football</a></li>
					<li><a href="running.php">Running</a></li>
				</ul>
			</form>
			<?php echo "<a href='cart.php?id=" . $id . "&action=view'><button class='btn-cart'><i class='icon-shopping-cart icon-white'></i></button></a>" ?>
		</div>
		<div class="product-list">
			<?php
			include('function/addcart.php');

			$query = mysqli_query($conn, "SELECT *FROM product WHERE category='basketball' ORDER BY product_id DESC");

			while ($fetch = mysqli_fetch_array($query)) {

				$pid = $fetch['product_id'];

				$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE product_id = '$pid'");
				$rows = mysqli_fetch_array($query1);

				$qty = $rows['qty'];
				if ($qty <= 5) {
				} else {
					echo "<div class='product-item'>";
					echo "<a href='details.php?id=" . $fetch['product_id'] . "'><img class='product-image' src='photo/" . $fetch['product_image'] . "' height = '300px' width = '300px'></a>";
					echo "<div class='text-container'>";
					echo "<h2 class='product-name'>" . $fetch['product_name'] . "</h2>";
					echo "<p class='product-price'>Rp " . $fetch['product_price'] . "</p>";
					echo "</div>";
					echo "<button class='product-detail-button' onclick=\"location.href='details.php?id=" . $fetch['product_id'] . "'\" aria-label='ORDER NOW'>View Detail</button>";
					echo "</div>";
				}
			}
			?>
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