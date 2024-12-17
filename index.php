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
						<li><a href="account.php"><?php echo $fetch['name']; ?></a></li>
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
		</div>
		<div class="modal-footer">
			<input class="btn btn-primary" type="submit" name="login" value="Login">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
			</form>
		</div>
	</div>

	<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:700px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3 id="myModalLabel">Sign Up Here...</h3>
		</div>
		<div class="modal-body">
			<center>
				<form method="post">
					<input type="text" name="name" placeholder="name" required>
					<input type="text" name="address" placeholder="Address" style="width:430px;" required>
					<input type="text" name="country" placeholder="Country" required>
					<input type="text" name="zipcode" placeholder="ZIP Code" required maxlength="4">
					<input type="text" name="telephone" placeholder="Telephone Number" maxlength="8">
					<input type="email" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Password" required>
			</center>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="signup" value="Sign Up">
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
		</form>
	</div>
	<br>
	<section id="jumbotron" class="jumbotron">
		<div class="content">
			<h1>Footwearin.</h1>
			<p>Temukan Sepatu Terbaikmu</p>
		</div>
		<div class="strip-container">
			<div class="jumbotron-strip">
				<div class="jumbotron-strip-container">
					<img src="img/banner.png"></img>
					<img src="img/banner.png"></img>
					<img src="img/banner.png"></img>
				</div>
				<div class="jumbotron-strip-container">
					<img src="img/banner.png"></img>
					<img src="img/banner.png"></img>
					<img src="img/banner.png"></img>
				</div>
			</div>
		</div>
	</section>

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
								<td class="profile"><?php echo $fetch['name']; ?>; ?></td>
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
		<section class="product">
			<div class="cat-container">
				<h2>Basketball</h2>
				<a href="product.php">View All</a>
			</div>
			<div class="product-list">
				<?php
				$query = mysqli_query($conn, "SELECT * FROM product WHERE category='Basketball' ORDER BY product_id ASC LIMIT 5");

				while ($fetch = mysqli_fetch_array($query)) {
					$pid = $fetch['product_id'];
					$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE product_id = '$pid'");
					$rows = mysqli_fetch_array($query1);
					$qty = $rows['qty'];

					if ($qty > 5) {
						echo "<div class='product-item'>";
						echo "<a href='details.php?id=" . $fetch['product_id'] . "'><img class='product-image' src='photo/" . $fetch['product_image'] . "' height = '300px' width = '300px'></a>";
						echo "<div class='text-container'>";
						echo "<h2 class='product-name'>" . $fetch['product_name'] . "</h2>";
						echo "<p class='product-price'>Rp " . $fetch['product_price'] . "</p>";
						echo "</div>";
						echo "<button class='product-detail-button' onclick=\"location.href='details.php?id=" . $fetch['product_id'] . "'\" aria-label='Lihat Produk'>ORDER NOW</button>";
						echo "</div>";
					}
				}
				?>
			</div>
		</section>
		<section class="product">
			<div class="cat-container">
				<h2>Football</h2>
				<a href="football.php">View All</a>
			</div>
			<div class="product-list">
				<?php
				$query = mysqli_query($conn, "SELECT * FROM product WHERE category='Football' ORDER BY product_id ASC LIMIT 5");

				while ($fetch = mysqli_fetch_array($query)) {
					$pid = $fetch['product_id'];
					$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE product_id = '$pid'");
					$rows = mysqli_fetch_array($query1);
					$qty = $rows['qty'];

					if ($qty > 5) {
						echo "<div class='product-item'>";
						echo "<a href='details.php?id=" . $fetch['product_id'] . "'><img class='product-image' src='photo/" . $fetch['product_image'] . "'></a>";
						echo "<div class='text-container'>";
						echo "<h2 class='product-name'>" . $fetch['product_name'] . "</h2>";
						echo "<p class='product-price'>Rp " . $fetch['product_price'] . "</p>";
						echo "</div>";
						echo "<button class='product-detail-button' onclick=\"location.href='details.php?id=" . $fetch['product_id'] . "'\" aria-label='Lihat Produk'>ORDER NOW</button>";
						echo "</div>";
					}
				}
				?>
			</div>
		</section>
		<section class="product">
			<div class="cat-container">
				<h2>Running</h2>
				<a href="running.php">View All</a>
			</div>
			<div class="product-list">
				<?php
				$query = mysqli_query($conn, "SELECT * FROM product WHERE category='Running' ORDER BY product_id ASC LIMIT 5");

				while ($fetch = mysqli_fetch_array($query)) {
					$pid = $fetch['product_id'];
					$query1 = mysqli_query($conn, "SELECT * FROM stock WHERE product_id = '$pid'");
					$rows = mysqli_fetch_array($query1);
					$qty = $rows['qty'];

					if ($qty > 5) {
						echo "<div class='product-item'>";
						echo "<a href='details.php?id=" . $fetch['product_id'] . "'><img class='product-image' src='photo/" . $fetch['product_image'] . "'></a>";
						echo "<div class='text-container'>";
						echo "<h2 class='product-name'>" . $fetch['product_name'] . "</h2>";
						echo "<p class='product-price'>Rp " . $fetch['product_price'] . "</p>";
						echo "</div>";
						echo "<button class='product-detail-button' onclick=\"location.href='details.php?id=" . $fetch['product_id'] . "'\" aria-label='Lihat Produk'>ORDER NOW</button>";
						echo "</div>";
					}
				}
				?>
			</div>
		</section>
		<section>
			<div class="promotion">
				<p>Don't wait any longer, <b> Get it now! </b></p>
				<button class='product-button' onclick="location.href='product.php'">ORDER NOW</button>
			</div>
		</section>
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
					<a href="#login" data-toggle="modal">Login</a>
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