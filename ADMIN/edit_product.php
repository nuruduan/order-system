<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'] ?? 0;
$result = mysqli_query($dbconn, "SELECT * FROM products WHERE product_id = $id");
$product = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image'];
        $image_name = basename($image["name"]);
        $target_file = "../img/menu/" . $image_name;
        move_uploaded_file($image["tmp_name"], $target_file);
    } else {
        $image_name = $product['image_url'];
    }

    $stmt = $dbconn->prepare("UPDATE products SET name = ?, price = ?, image_url = ? WHERE product_id = ?");
    $stmt->bind_param("sdsi", $name, $price, $image_name, $id);
    $stmt->execute();

    header("Location: ../menu.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
                <h4 class="mb-4">✏️ Edit Product</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (RM):</label>
                        <input type="number" class="form-control" step="0.01" name="price" value="<?= $product['price'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Change Image (optional):</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <small class="text-muted">Current: <?= htmlspecialchars($product['image_url']) ?></small>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
