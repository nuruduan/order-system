<?php
session_start();
include('../include/dbconn.php');

// Only allow admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Optional: Delete image file if stored on server

    // Delete product from database
    $delete_sql = "DELETE FROM products WHERE product_id = $product_id";
    if (mysqli_query($dbconn, $delete_sql)) {
        header("Location: ../menu.php?msg=deleted");
    } else {
        echo "Error deleting product: " . mysqli_error($dbconn);
    }
} else {
    header("Location: ../menu.php");
    exit();
}
?>
