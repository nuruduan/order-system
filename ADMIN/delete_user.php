<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'] ?? 0;

// Step 1: Get all orders by user
$ordersResult = mysqli_query($dbconn, "SELECT order_id FROM orders WHERE user_id = $id");

while ($order = mysqli_fetch_assoc($ordersResult)) {
    $orderId = $order['order_id'];

    // Step 2: Delete order details for each order
    mysqli_query($dbconn, "DELETE FROM order_details WHERE order_id = $orderId");

    // Step 3: Delete the order
    mysqli_query($dbconn, "DELETE FROM orders WHERE order_id = $orderId");
}

// Step 4: Finally delete the user
mysqli_query($dbconn, "DELETE FROM user WHERE user_id = $id");

header("Location: users_list.php");
exit();
?>
