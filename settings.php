<?php
// Database connection settings
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "project2_db";

// Disable mysqli exception mode for error handling
mysqli_report(MYSQLI_REPORT_OFF);

// Try to connect to the database
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// If connection fails, try to create the database
if (!$conn) {
    // Connect without specifying database
    $conn = mysqli_connect($host, $user, $pwd);
    
    if ($conn) {
        // Create the database
        $sql = "CREATE DATABASE IF NOT EXISTS `$sql_db`";
        mysqli_query($conn, $sql);
        
        // Close and reconnect with the new database
        mysqli_close($conn);
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    } else {
        die("ERROR: Could not connect to MySQL server. " . mysqli_connect_error());
    }
}

// Re-enable exception mode for better error handling in queries
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

