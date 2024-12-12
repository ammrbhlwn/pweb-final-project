<?php
include("function/login.php");
include("function/customer_signup.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Demis</title>
	<link rel="icon" href="img/logoDemis.jpeg" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/carousel.js"></script>
	<script src="js/button.js"></script>
	<script src="js/dropdown.js"></script>
	<script src="js/tab.js"></script>
	<script src="js/tooltip.js"></script>
	<script src="js/popover.js"></script>
	<script src="js/collapse.js"></script>
	<script src="js/modal.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/alert.js"></script>
	<script src="js/transition.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="header">
		<img src="img/logoDemis.jpeg">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="aboutus.php">About</a></li>
			<li><a href="product.php">Merch</a></li>
		</ul>
		<ul>
			<li><a href="#signup" data-toggle="modal">Sign Up</a></li>
			<li><a href="#login" data-toggle="modal">Login</a></li>
		</ul>
	</div>
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
	<div class="nav1">
		<form method="post">
			<?php
			include('function/addcart.php');
			?>
			<ul class="nav-list">
				<li><a href="product.php" class="nav-link">Basketball</a></li>
				<li>|</li>
				<li><a href="football.php" class="nav-link active">Football</a></li>
				<li>|</li>
				<li><a href="running.php" class="nav-link">Running</a></li>
			</ul>
		</form>
		<?php echo "<a href='cart.php?id=" . $id . "&action=view'><button class='btn btn-inverse' style='right:1%; position:fixed; top:10%;'><i class='icon-shopping-cart icon-white'></i> View Cart</button></a>" ?>
	</div>
	<div id="container">

		<div class="product-list">

			<?php

			$query = mysqli_query($conn, "SELECT *FROM product WHERE category='football' ORDER BY product_id DESC");

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
					echo "<button class='product-detail-button' onclick=\"location.href='details.php?id=" . $fetch['product_id'] . "'\" aria-label='Lihat Produk'>View Detail</button>";
					echo "</div>";
					echo "</div>";
				}
			}
			?>
		</div>
	</div>




	<br />
	</div>
	<br />
	<div id="footer">
		<div class="foot">
			<label style="font-size:17px;"> Copyrght &copy; </label>
			<p style="font-size:25px;">Demis Inc. 2024</p>
		</div>

		<div id="foot">
			<h4>Links</h4>
			<ul>
				<a href="http://www.facebook.com/Demis">
					<li>Facebook</li>
				</a>
				<a href="http://www.twitter.com/Demis">
					<li>Twitter</li>
				</a>
				<a href="http://www.pinterest.com/Demis">
					<li>Pinterest</li>
				</a>
				<a href="http://www.tumblr.com/Demis">
					<li>Tumblr</li>
				</a>
			</ul>
		</div>
	</div>
</body>

</html>