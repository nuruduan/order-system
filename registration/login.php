<?php
session_start();
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registration'])) {
    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($dbconn, $_POST['username']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    // Query user by username
    $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($dbconn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check password
        if ($row['password'] === $password) {
            // Set session username and user level
            $_SESSION['username'] = $row['username'];
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['level'] = $row['level_id'];
            $level_id = $row['level_id'];

            // Redirect based on level
            if ($level_id == 1) {
                $_SESSION['base_path'] = "/dessert-order/ADMIN";
				header('Location: /dessert-order/ADMIN');
                exit();
            } elseif ($level_id == 2) {
                $_SESSION['base_path'] = "/dessert-order/USER";
				header('Location: /dessert-order/USER');
                exit();
            } elseif ($level_id == 3) {
				$_SESSION['base_path'] = "/dessert-order/STAFF";

				// Check if staff_profile already exists
				$user_id = $row['user_id'];
				$checkStaff = mysqli_query($dbconn, "SELECT * FROM staff_profile WHERE user_id = $user_id");

				if (mysqli_num_rows($checkStaff) == 0) {
					// Insert new staff_profile
					$insertStaff = mysqli_query($dbconn, "INSERT INTO staff_profile (user_id) VALUES ($user_id)");
				}

				header('Location: /dessert-order/STAFF');
				exit();
			}
			else {
                $_SESSION['base_path'] = "/dessert-order/";
				header('Location: /dessert-order/index.html');
                exit();
            }
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
            exit();
        }
    } else {
        // Username not found
        echo "<script>alert('Username not found'); window.location.href='login.html';</script>";
        exit();
    }
}

mysqli_close($dbconn);
?>
