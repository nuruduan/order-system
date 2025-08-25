<?php
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];
    $level_id = $_POST['level_id'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];

    // Check if username exists
    $stmt = $dbconn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists'); window.location.href='signup.html';</script>";
    } else {
        // Insert user
        $stmt = $dbconn->prepare("INSERT INTO user (username, telephone, password, level_id, fullName, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $username, $telephone, $password, $level_id, $fullName, $email);

        if ($stmt->execute()) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $stmt->insert_id;

            if ($level_id == 3) {
                // Insert into staff_profile only if staff
                $user_id = $_SESSION['user_id'];
                $staff_stmt = $dbconn->prepare("INSERT INTO staff_profile (user_id) VALUES (?)");
                $staff_stmt->bind_param("i", $user_id);
                $staff_stmt->execute();
                $staff_stmt->close();
            }

            // Redirect based on level
            switch ($level_id) {
                case 1:
                    header('Location: /dessert-order/ADMIN/');
                    break;
                case 2:
                    header('Location: /dessert-order/USER/');
                    break;
                case 3:
                    header('Location: /dessert-order/STAFF/');
                    break;
                default:
                    header('Location: /dessert-order/index.html');
            }
            exit();

        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $dbconn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

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

<div class="page">
    <div class="container">
        <div class="left">
        <div class="login">Sign Up</div>
        <div class="eula">Welcome fellow human!</div>
        </div>
        <div class="right">
            <svg viewBox="0 0 320 300">

                <defs>
                <linearGradient
                                inkscape:collect="always"
                                id="linearGradient"
                                x1="13"
                                y1="193.49992"
                                x2="307"
                                y2="193.49992"
                                gradientUnits="userSpaceOnUse">
                    <stop
                        style="stop-color:#ff00ff;"
                        offset="0"
                        id="stop876" />
                    <stop
                        style="stop-color:#ff0000;"
                        offset="1"
                        id="stop878" />
                </linearGradient>
                </defs>
                <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
            </svg>
            <form class="form" action="signup.php" method="POST">
			<input type="hidden" name="action" value="signup" />
                <div class="input-wrapper">
                  <label for="username">Username</label>
                  <input type="text" id="username" name="username" required />
              
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
				
				<label for="fullName">Full Name</label>
                <input type="fullName" id="fullName" name="fullName" required>
				
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
				
              
                <label for="phoneNum">Phone Number</label>
                <input type="tel" id="telephone" name="telephone" required>
              
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
				
				<input type="hidden" name="level_id" value="2"> <!-- Always user -->
              
                <div class="submit-wrapper">
                  <input type="submit" id="submit" value="Submit">
                </div>
              </form>
        </div>
    </div>
</div>

<div style="max-width: 1140px; margin: 20px auto;">
    <a href="/dessert-order/index.html" class="btn btn-secondary mb-3" style="position: relative; left: 0; margin-left: 20px;">← Back</a>
</div>

<!-- Js Plugins-->
<script src="js/signup.js"></script>
