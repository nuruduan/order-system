<?php
include('../include/dbconn.php');

$name = $_POST['name'];
$price = $_POST['price'];
$product_id = $_POST['product_id'] ?? null;
$image_url = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image_name = basename($_FILES['image']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . time() . "_" . $image_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_url = "images/" . time() . "_" . $image_name;
    }
}

if ($product_id) {
    // Update
    if ($image_url) {
        $sql = "UPDATE products SET name='$name', price='$price', image_url='$image_url' WHERE product_id='$product_id'";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price' WHERE product_id='$product_id'";
    }
} else {
    // Insert
    $sql = "INSERT INTO products (name, price, image_url) VALUES ('$name', '$price', '$image_url')";
}

if (mysqli_query($dbconn, $sql)) {
    header("Location: admin_menu.php");
} else {
    echo "Error: " . mysqli_error($dbconn);
}
?>
