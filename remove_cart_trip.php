<?php
// Start the session
session_start();

// Get the product ID from the query string
$product_id = $_GET['product_id'];

// Remove the product from the cart
if (isset($_SESSION['cart'][$product_id])) {
    unset($_SESSION['cart'][$product_id]);
}

// Redirect the user back to the cart page
header('Location: cart.php');
exit();
?>