<?php
include("function/session.php");
include("db/dbconn.php");
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
								<td class="profile"><?php echo $fetch['name']; ?></td>
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
		<div id="container">
			<form method="post" class="well" style="background-color:#fff;">
				<table class="table">
					<label style="font-size:25px;">My Cart</label>
					<tr>
						<th>
							<h3>Image</h3>
							</td>
						<th>
							<h3>Product Name</h3>
						</th>
						<th>
							<h3>Size</h3>
						</th>
						<th>
							<h3>Quantity</h3>
						</th>
						<th>
							<h3>Price</h3>
						</th>
						<th>
							<h3>Add</h3>
						</th>
						<th>
							<h3>Remove</h3>
						</th>
						<th>
							<h3>Subtotal</h3>
						</th>
					</tr>

					<?php


					if (isset($_GET['id']))
						$id = $_GET['id'];
					else
						$id = 1;
					if (isset($_GET['action']))
						$action = $_GET['action'];
					else
						$action = "empty";

					switch ($action) {

						case "view":
							if (isset($_SESSION['cart'][$id]))
								$_SESSION['cart'][$id];
							break;
						case "add":
							if (isset($_SESSION['cart'][$id]))
								$_SESSION['cart'][$id]++;
							else
								$_SESSION['cart'][$id] = 1;
							break;
						case "remove":
							if (isset($_SESSION['cart'][$id])) {
								$_SESSION['cart'][$id]--;
								if ($_SESSION['cart'][$id] == 0)
									unset($_SESSION['cart'][$id]);
							}
							break;
						case "empty":
							unset($_SESSION['cart']);
							break;
					}
					if (isset($_SESSION['cart'])) {

						$total = 0;
						foreach ($_SESSION['cart'] as $id => $x) {
							$result = mysqli_query($conn, "Select * from product where product_id=$id");
							$myrow = mysqli_fetch_array($result);
							$name = $myrow['product_name'];
							$name = substr($name, 0, 40);
							$price = $myrow['product_price'];
							$image = $myrow['product_image'];
							$product_size = $myrow['product_size'];
							$line_cost = $price * $x;
							$total = $total + $line_cost;


							echo "<tr class='table'>";
							echo "<td><h4><img height='70px' width='70px' src='photo/" . $image . "'></h4></td>";
							echo "<td><h4><input type='hidden' required value='" . $id . "' name='pid[]'> " . $name . "</h4></td>";
							echo "<td><h4>" . $product_size . "</h4></td>";
							echo "<td><h4><input type='hidden' required value='" . $x . "' name='qty[]'> " . $x . "</h4></td>";
							echo "<td><h4>" . $price . "</h4></td>";
							echo "<td><h4><a href='cart.php?id=" . $id . "&action=add'><i class='icon-plus-sign'></i></a></td>";
							echo "<td><h4><a href='cart.php?id=" . $id . "&action=remove'><i class='icon-minus-sign'></i></a></td>";
							echo "<td><strong><h3>Rp " . $line_cost . "</h3></strong>";
							echo "</tr>";
						}

						echo "<tr>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td><h2>TOTAL:</h2></td>";
						echo "<td><strong><input type='hidden' value='" . $total . "' required name='total'><h2 class='text-danger'>Rp " . $total . "</h2></strong></td>";
						echo "<td></td>";
						echo "<td><a class='btn btn-danger btn-sm pull-right' href='cart.php?id=" . $id . "&action=empty'><i class='fa fa-trash-o'></i> Empty cart</a></td>";
						echo "</tr>";
					} else
						echo "<font color='#111' class='alert alert-error' style='float:right'>Cart is empty</font>";

					?>
				</table>


				<div class='pull-right'>
					<a href='product.php' class='btn btn-inverse btn-lg'>Continue Shopping</a>
					<?php echo "<button name='pay_now' type='submit' class='btn btn-inverse btn-lg' >Purchase</button>";
					include("function/paypal.php");
					?>
			</form>
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