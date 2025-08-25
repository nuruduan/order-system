<?php
session_start();

$product_id = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = (int) $_POST['quantity'];

// If product already in cart, increase quantity
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = [
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity
    ];
}

header('Location: menu.php');
exit();
?>
