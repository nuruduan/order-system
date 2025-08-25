<?php
session_start();
include(__DIR__ . '/../include/dbconn.php');

// Timeout control
$inactive = 600;
if (isset($_SESSION["timeout"])) {
    $session_life = time() - $_SESSION["timeout"];
    if ($session_life > $inactive) {
        header("Location: ../registration/logout.php");
        exit();
    }
}
$_SESSION["timeout"] = time();

// Set user level & base_path if not set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (!isset($_SESSION['level']) || !isset($_SESSION['base_path'])) {
        $user_query = mysqli_query($dbconn, "SELECT user_id, level_id FROM user WHERE username = '$username'");
        $user = mysqli_fetch_assoc($user_query);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['level'] = $user['level_id'];

        switch ($_SESSION['level']) {
            case 1:
                $_SESSION['base_path'] = "/dessert-order/ADMIN";
                break;
            case 2:
                $_SESSION['base_path'] = "/dessert-order/USER";
                break;
            case 3:
                $_SESSION['base_path'] = "/dessert-order/STAFF";
                break;
            default:
                $_SESSION['base_path'] = "/dessert-order";
                break;
        }
    }

    // Now always define $base_path for use in nav
    $base_path = $_SESSION['base_path'];
} else {
    // Not logged in
    header('Location: ../registration/login.php');
    exit();
}
?>
