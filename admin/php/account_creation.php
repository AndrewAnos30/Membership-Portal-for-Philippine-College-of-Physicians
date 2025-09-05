<?php
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = trim($_POST['role']);

    if ($password !== $confirmPassword) {
        die("Passwords do not match!");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into account
    $stmt = $conn->prepare("INSERT INTO account (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        // Redirect with membership_no (username) to next step
        header("Location: personal-info_creation.php?member_no=" . urlencode($username));
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
