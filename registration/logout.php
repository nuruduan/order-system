<?php
// Initialize session
session_start();

// Delete session variables
unset($_SESSION['username']);
session_unset(); 
session_destroy();

// Redirect to main index.html
header('Location: ../index.html');
exit();
?>
