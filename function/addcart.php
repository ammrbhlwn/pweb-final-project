<?php

if (isset($_POST['add'])) {

	$prod_id = $_POST['product_id'];
	$cust_id = $_POST['customerid'];

	mysqli_query($conn, "INSERT INTO cart (prod_id,cust_id)  VALUES ('$prod_id', '$cust_id')  ");

	header("location: product.php");
}
