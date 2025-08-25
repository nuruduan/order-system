<?php
session_start();
include('../include/dbconn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_ids = $_POST['product_ids'];
    $quantities = $_POST['quantities'];

    $total = 0;
    $order_items = [];

    // Loop through submitted items
    for ($i = 0; $i < count($product_ids); $i++) {
        $product_id = (int)$product_ids[$i];
        $quantity = (int)$quantities[$i];

        if ($quantity > 0) {
            $product = mysqli_fetch_assoc(mysqli_query($dbconn, "SELECT price FROM products WHERE product_id = $product_id"));
            $price = $product['price'];
            $item_total = $price * $quantity;
            $total += $item_total;

            $order_items[] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price
            ];
        }
    }

    if (count($order_items) > 0) {
        // Insert order
        mysqli_query($dbconn, "INSERT INTO orders (user_id, order_date, total, status) VALUES ($user_id, NOW(), $total, 'Pending')");
        $order_id = mysqli_insert_id($dbconn);

        // Insert each product into order_details
        foreach ($order_items as $item) {
            $pid = $item['product_id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            mysqli_query($dbconn, "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ($order_id, $pid, $qty, $price)");
        }

        echo "<script>alert('Order placed successfully!'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Please select at least one product to order.'); window.location.href='menu.php';</script>";
    }
}

?>
