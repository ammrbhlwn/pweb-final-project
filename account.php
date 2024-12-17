<?php
include("function/session.php");
include("db/dbconn.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Footwearin.</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="container">


		<?php

		$id = (int) $_SESSION['id'];

		$query = mysqli_query($conn, "SELECT * FROM customer WHERE customerid = '$id' ");
		$fetch = mysqli_fetch_array($query); {
			$name = $fetch['name'];
			$address = $fetch['address'];
			$country = $fetch['country'];
			$zipcode = $fetch['zipcode'];
			$telephone = $fetch['telephone'];
			$email = $fetch['email'];
			$password = $fetch['password'];
			$customerid = $fetch['customerid'];
		}
		?>
		<div id="account">
			<form method="POST" action="function/edit_customer.php">
				<center>
					<h3>Edit My Account</h3>
					<table>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" placeholder="name" required value="<?php echo $name; ?>"></td>
						</tr>
						<tr>
							<td>Address:</td>
							<td><input type="text" name="address" placeholder="Address" style="width:430px;" required value="<?php echo $address; ?>"></td>
						</tr>
						<tr>
							<td>Country:</td>
							<td><input type="text" name="country" placeholder="Country" required value="<?php echo $country; ?>"></td>
						</tr>
						<tr>
							<td>ZIP Code:</td>
							<td><input type="text" name="zipcode" placeholder="ZIP Code" required value="<?php echo $zipcode; ?>" maxlength="4"></td>
						</tr>
						<tr>
							<td>Telephone Number:</td>
							<td><input type="text" name="telephone" placeholder="Telephone Number" value="<?php echo $telephone; ?>" maxlength="8"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="email" name="email" placeholder="Email" required value="<?php echo $email; ?>"></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="password" placeholder="Password" required value="<?php echo $password; ?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="edit" value="Save Changes" class="btn btn-primary">&nbsp;<a href="index.php"><input type="button" name="cancel" value="Cancel" class="btn btn-danger"></a></td>
						</tr>
					</table>
				</center>
			</form>
		</div>



		<br>

	</div>
</body>

</html>