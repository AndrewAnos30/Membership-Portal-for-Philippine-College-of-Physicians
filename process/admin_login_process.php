<?php
session_start();
include '../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query the admin table
    $stmt = $conn->prepare("SELECT id, username, password, role FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Check password (must be hashed in DB)
        if (password_verify($password, $row['password'])) {
            // Save login session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id']       = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['admin_role']     = $row['role'];

            // Set a success message for the welcome popup
            $_SESSION['login_success'] = "Hi, " . $row['username'] . "!";

            // Redirect to admin dashboard
            header("Location: ../admin/dashboard.php");
            exit;
        }
    }

    // If login fails, set session error and redirect
    $_SESSION['login_error'] = "Invalid username or password";
    header("Location: ../adminLogin_pcp.php");
    exit;
}
?>
