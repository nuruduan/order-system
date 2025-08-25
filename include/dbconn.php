<?php
// Database connection details
$host = "localhost";     
$user = "root";          
$password = "";          
$database = "dessertdb"; 

// Create connection
$dbconn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
