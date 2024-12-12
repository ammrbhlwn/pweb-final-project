<?php

if (isset($_POST['add'])) {


	$customer = $_POST['customer'];
	$product = $_POST['product_name'];
	$price = $_POST['product_price'];
	$qty = $_POST['qty'];
	$amount = $_POST['amout'];

	mysqli_query($conn, "INSERT INTO cart (prod_id,cust_id)  VALUES ('$prod_id', '$cust_id')  ");

	header("location: product.php");
}
