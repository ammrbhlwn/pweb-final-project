<?php
session_start();
include('../function/admin_login.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Footwearin.</title>
	<link rel="icon" href="img/logoFootwearin.png" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div id="admin">
		<form method="post" class="well">
			<center>
				<legend>Adminstrator</legend>
				<table>
					<tr>
						<input type="text" name="username" placeholder="Username">
					</tr>
					<tr>
						<input type="password" name="password" placeholder="Password">
					</tr>
					<br>
					<br>
					<input type="submit" name="enter" value="Enter" class="btn btn-primary" style="width:200px;">
				</table>
			</center>
		</form>
	</div>
	</div>
</body>

</html>