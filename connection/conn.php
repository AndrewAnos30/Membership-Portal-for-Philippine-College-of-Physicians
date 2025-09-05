<?php
/*
// Block direct access to this file
if (!defined('SECURE_ACCESS')) {
    http_response_code(403);
    exit('Direct access not allowed.');
}
*/
// Database credentials for XAMPP
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default has no password
$database = "pcpdrm";

// Create MySQLi connection
$conn = new mysqli($servername, $username, $password, $database);

// Error handling (secure)
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("An internal error occurred. Please try again later.");
}
?>
