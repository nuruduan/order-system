<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    $target_dir = "../img/menu/";
    $image_name = basename($image["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($image["tmp_name"], $target_file);

    $stmt = $dbconn->prepare("INSERT INTO products (name, price, image_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image_name);
    $stmt->execute();

    header("Location: ../menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div style="position: sticky; top: 0; background: #e2e2e5; z-index: 1000; padding: 10px 20px;">
    <a href="../menu.php" class="btn btn-secondary">← Back</a>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="p-4 border rounded shadow-sm bg-light">
                <h4 class="mb-4">➕ Add New Product</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (RM):</label>
                        <input type="number" class="form-control" step="0.01" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image:</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
