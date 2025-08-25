<?php
include('../registration/session.php');
include('../include/dbconn.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit();
}

$username = $_SESSION['username'];

// Get user data
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dbconn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>

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
            <div class="login">PROFILE</div>
            <div class="eula" style="font-size: 20px; color: #FF1493; font-weight: bold;">
    Hello, <?php echo htmlspecialchars($user['username']); ?>!
</div>
        </div>
        <div class="right">
            <svg viewBox="0 0 320 300">
                <defs>
                    <linearGradient id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                        <stop style="stop-color:#ff00ff;" offset="0" />
                        <stop style="stop-color:#ff0000;" offset="1" />
                    </linearGradient>
                </defs>
                <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016
                         0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5
                         0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25
                         0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25
                         0,24.00396 20,25 20,25 h 168.57143" />
            </svg>

            <form class="form" action="update_profile.php" method="POST">
                <div class="input-wrapper">
                    <label>Username :</label>
                    <input type="text" id="username" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>">
                    <svg class="input-underline" viewBox="0 0 100 4" preserveAspectRatio="none">
                        <defs>
                            <linearGradient id="linearGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#f0f" />
                                <stop offset="100%" stop-color="#f00" />
                            </linearGradient>
                        </defs>
                        <path d="M 0 2 H 100" stroke="url(#linearGradient)" stroke-width="4" fill="none" />
                    </svg>
                </div>
				
				<label>Full Name :</label>
				<input type="text" id="fullname" name="fullName" value="<?php echo htmlspecialchars($user['fullName']); ?>">

                <label>Telephone :</label>
                <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($user['telephone']); ?>">

				<label>Email :</label>
				<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
				
				<label>New Password :</label>
                <input type="password" id="password" name="password" placeholder="Leave blank to keep current">

                <div class="submit-wrapper">
                    <input type="submit" id="submit" value="Update Profile">
                </div>
            </form>
        </div>
    </div>
</div>

<div style="position: sticky; top: 0; background: #e2e2e5; z-index: 1000; padding: 10px 20px;">
    <a href="<?= $base_path ?>/index.php" class="btn btn-secondary">← Back</a>
</div>

<!-- Js Plugins -->
<script src="js/signup.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; // current username
    $new_username = trim($_POST['new_username']);
    $telephone = trim($_POST['telephone']);
    $password = trim($_POST['password']);
	$fullName = trim($_POST['fullName']);
	$email = trim($_POST['email']);


    $updates = [];

    if (!empty($new_username)) {
        $updates[] = "username = '" . mysqli_real_escape_string($dbconn, $new_username) . "'";
    }
    if (!empty($telephone)) {
        $updates[] = "telephone = '" . mysqli_real_escape_string($dbconn, $telephone) . "'";
    }
    if (!empty($password)) {
        $updates[] = "password = '" . mysqli_real_escape_string($dbconn, $password) . "'";
    }
	
	if (!empty($fullName)) {
    $updates[] = "fullName = '" . mysqli_real_escape_string($dbconn, $fullName) . "'";
}
	if (!empty($email)) {
    $updates[] = "email = '" . mysqli_real_escape_string($dbconn, $email) . "'";
}


    if (!empty($updates)) {
        $sql = "UPDATE user SET " . implode(", ", $updates) . " WHERE username = '" . mysqli_real_escape_string($dbconn, $username) . "'";

        if (mysqli_query($dbconn, $sql)) {
            if (!empty($new_username)) {
                $_SESSION['username'] = $new_username;
            }
            echo "<script>alert('Profile updated successfully.'); window.location.href='update_profile.php';</script>";
        } else {
            echo "<script>alert('Error updating profile: " . mysqli_error($dbconn) . "');</script>";
        }
    } else {
        echo "<script>alert('No changes made.');</script>";
    }

    mysqli_close($dbconn);
}
?>