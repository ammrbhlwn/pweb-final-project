<?php

include('../db/dbconn.php');
if (isset($_POST['cash'])) {
	$customer = $_POST['customer'];
	$product = $_POST['product_name'];
	$total = $_POST['product_price'];
	$destination = $_POST['destination'];

	mysqli_query($conn, "INSERT INTO `transaction` (customer, product, size, amount, payment) VALUES ('$customer', '$product', $total, '$destination', 'COD')");
}
