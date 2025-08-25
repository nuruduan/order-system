<?php
session_start();
include('./include/dbconn.php');

$user_id = $_SESSION['user_id'];
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
