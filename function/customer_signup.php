<?php

include('db/dbconn.php');
if (isset($_POST['signup'])) {
	$address = $_POST['address'];
	$country = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `customer` WHERE `email` = '$email'"));
	if ($check == 1) {
		echo "<script>alert('EMAIL ALREADY EXIST')</script>";
	} else {
		mysqli_query($conn, "INSERT INTO customer (name, address, country, zipcode, telephone, email, password)
					VALUES ('$name', '$address', '$country', '$zipcode', '$telephone', '$email', '$password')");
	}
}
