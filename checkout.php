<?php
session_start();
include('include/dbconn.php');

// Get user_id securely from session
if (!isset($_SESSION['username'])) {
    header("Location: registration/login.php");
    exit();
}

// Fetch user_id based on session username
$username = $_SESSION['username'];
$user_result = mysqli_query($dbconn, "SELECT user_id FROM user WHERE username = '$username'");
$user = mysqli_fetch_assoc($user_result);
$user_id = $user['user_id'];

$cart = $_SESSION['cart'];

if (empty($cart)) {
    echo "<script>alert('Cart is empty.'); window.location.href='menu.php';</script>";
    exit();
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Insert order
mysqli_query($dbconn, "INSERT INTO orders (user_id, order_date, total, status) VALUES ($user_id, NOW(), $total, 'Pending')");
$order_id = mysqli_insert_id($dbconn);

// Insert order details
foreach ($cart as $product_id => $item) {
    $qty = $item['quantity'];
    $price = $item['price'];
    mysqli_query($dbconn, "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $qty, $price)");
}

unset($_SESSION['cart']); // Clear cart

echo "<script>alert('Order placed successfully!'); window.location.href='menu.php';</script>";
?>
