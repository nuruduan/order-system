<?php
session_start();
include('../include/dbconn.php');

if (isset($_POST['registration'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL to prevent SQL injection
    $stmt = mysqli_prepare($dbconn, "SELECT username, password, level_id FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 0) {
        // No user found
        header('Location: indexwrong.html');
        exit();
    } else {
        // Bind result
        mysqli_stmt_bind_result($stmt, $db_username, $db_password, $level);
        mysqli_stmt_fetch($stmt);

        // Verify the password
        if ($password === $db_password) {
            // Set session variables
            $_SESSION['username'] = $db_username;
            $_SESSION['level'] = $level;

            // Set base_path based on level
            switch ($level) {
                case 1:
                    $_SESSION['base_path'] = "/dessert-order/ADMIN";
                    header('Location: ../ADMIN/index.php');
                    break;
                case 2:
                    $_SESSION['base_path'] = "/dessert-order/USER";
                    header('Location: ../USER/index.php');
                    break;
                case 3:
                    $_SESSION['base_path'] = "/dessert-order/STAFF";
                    header('Location: ../STAFF/index.php');
                    break;
                default:
                    $_SESSION['base_path'] = "/dessert-order";
                    header('Location: ../index.html');
                    break;
            }
            exit(); // Make sure you always exit after header redirect
        } else {
            // Password incorrect
            header('Location: indexwrong.html');
            exit();
        }
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($dbconn);
?>
