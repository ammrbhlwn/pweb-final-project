<?php

include("../db/dbconn.php");
include("session.php");
if (isset($_POST['edit'])); {
	$id = $_SESSION['id'];

	$name = $_POST['name'];
	$address = $_POST['address'];
	$country = $_POST['country'];
	$zipcode = $_POST['zipcode'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	mysqli_query($conn, "UPDATE customer SET name='$name', address='$address',
							country='$country', zipcode='$zipcode', telephone='$telephone', 
							email='$email', password='$password' WHERE customerid='$id' ");

	header("location:../index.php");
}
