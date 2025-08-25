<?php
include('../include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password']; // plain for academic use
    $level_id = $_POST['level_id'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
	
	$is_admin = (isset($_SESSION['level']) && $_SESSION['level'] == 1);

if (!$is_admin) {
    // Force regular users to level 2
    $level_id = 2;
}

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
