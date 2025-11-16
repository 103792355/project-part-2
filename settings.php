<?php
// Database connection settings
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "project2_db";

// Create connection
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// Check connection and create database if it doesn't exist
if (!$conn) {
    $conn = @mysqli_connect($host, $user, $pwd);
    if ($conn) {
        $sql = "CREATE DATABASE IF NOT EXISTS $sql_db";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    }
}
?>

