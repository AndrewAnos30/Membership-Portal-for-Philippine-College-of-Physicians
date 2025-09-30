<?php
include '../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = trim($_POST['role']);

    if (!empty($username) && !empty($password) && !empty($role)) {
        // Hash password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            header("Location: ../../users.php?success=1");
            exit();
        } else {
            header("Location: ../../users.php?error=insert_failed");
            exit();
        }
    } else {
        header("Location: ../../users.php?error=missing_fields");
        exit();
    }
}
?>
