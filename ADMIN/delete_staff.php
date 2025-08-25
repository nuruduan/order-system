<?php
include('../registration/session.php');
include('../include/dbconn.php');

if ($_SESSION['level'] != 1) {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'] ?? 0;

// First delete from staff_profile, then from user
mysqli_query($dbconn, "DELETE FROM staff_profile WHERE user_id = $id");
mysqli_query($dbconn, "DELETE FROM user WHERE user_id = $id");

header("Location: staffs_list.php");
exit();
?>
