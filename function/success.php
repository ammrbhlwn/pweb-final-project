<?php
$item_no            = $_REQUEST['item_number'];
$item_transaction   = $_REQUEST['tx'];
$item_price         = $_REQUEST['amt'];
$item_currency      = $_REQUEST['cc'];

$price = '10.00';
$currency = 'USD';

if ($item_price == $price && $item_currency == $currency) {
    $content = "<h1>Welcome, Guest</h1>";
    $content .= "<h1>Payment Successful</h1>";
} else {
    $content = "<h1>Payment Failed</h1>";
}

$title = "PayPal Payment in PHP";
$heading = "Welcome to PayPal Payment PHP example.";
