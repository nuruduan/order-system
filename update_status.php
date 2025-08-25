<?php
session_start();
include('./include/dbconn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    if (isset($_SESSION['level']) && ($_SESSION['level'] == 1 || $_SESSION['level'] == 3)) {
        $user_id = $_SESSION['user_id'];

        // Get staff_id from staff_profile where user_id matches session user_id
        $staff_query = mysqli_query($dbconn, "SELECT staff_id FROM staff_profile WHERE user_id = $user_id");
        $staff_data = mysqli_fetch_assoc($staff_query);

        if ($staff_data) {
            $staff_id = $staff_data['staff_id'];

            // Update order with status and staff_id
            $stmt = $dbconn->prepare("UPDATE orders SET status = ?, staff_id = ? WHERE order_id = ?");
            $stmt->bind_param("sii", $new_status, $staff_id, $order_id);
            $stmt->execute();
            $stmt->close();

            header("Location: orders.php?updated=true");
            exit();
        } else {
            echo "Staff ID not found for this user.";
        }
    } else {
        echo "Unauthorized access.";
    }
}
?>