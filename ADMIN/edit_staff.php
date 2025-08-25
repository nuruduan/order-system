<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'] ?? 0;
$result = mysqli_query($dbconn, "SELECT * FROM user WHERE user_id = $id AND level_id = 3");
$staff = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $telephone = $_POST['telephone'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $stmt = $dbconn->prepare("UPDATE user SET username = ?, telephone = ?, fullName = ?, email = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi", $username, $telephone, $fullName, $email, $password, $id);
    } else {
        $stmt = $dbconn->prepare("UPDATE user SET username = ?, telephone = ?, fullName = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $username, $telephone, $fullName, $email, $id);
    }
    $stmt->execute();

    header("Location: staffs_list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff</title>
	
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/signup.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
	
</head>
<body>
<div class="page">
    <div class="container">
        <div class="left">
            <div class="login">EDIT STAFF</div>

        </div>
        <div class="right">
            <svg viewBox="0 0 320 300">
                <defs>
                    <linearGradient id="linearGradient" x1="13" y1="193.5" x2="307" y2="193.5" gradientUnits="userSpaceOnUse">
                        <stop style="stop-color:#ff00ff;" offset="0"/>
                        <stop style="stop-color:#ff0000;" offset="1"/>
                    </linearGradient>
                </defs>
                <path d="m 40,120 240,0 c 0,0 25,1 25,35 0,34 -25,35 -25,35 H 40 c 0,0 -25,4 -25,39 0,35 25,39 25,39 h 215 c 0,0 20,-1 20,-25 0,-24 -20,-25 -20,-25 H 65 c 0,0 -20,2 -20,25 0,24 20,25 20,25 h 169"/>
            </svg>

            <form class="form" method="POST">
                <div class="input-wrapper">
                    <label>Username :</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($staff['username']) ?>" required>
                    <svg class="input-underline" viewBox="0 0 100 4" preserveAspectRatio="none">
                        <path d="M 0 2 H 100"/>
                    </svg>
                </div>

                <label>Full Name :</label>
                <input type="text" name="fullName" value="<?= htmlspecialchars($staff['fullName']) ?>" required>

                <label>Telephone :</label>
                <input type="text" name="telephone" value="<?= htmlspecialchars($staff['telephone']) ?>" required>

                <label>Email :</label>
                <input type="email" name="email" value="<?= htmlspecialchars($staff['email']) ?>" required>

                <label>New Password (optional):</label>
                <input type="password" name="password" placeholder="Leave blank to keep current">

                <div class="submit-wrapper">
                    <input type="submit" id="submit" value="Update Staff">
                </div>
            </form>
        </div>
    </div>
</div>

<div style="position: sticky; top: 0; background: #e2e2e5; z-index: 1000; padding: 10px 20px;">
    <a href="staffs_list.php" class="btn btn-secondary">← Back</a>
</div>

</body>
</html>
