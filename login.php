<?php
session_start();
define('SECURE_ACCESS', true);
include 'connection/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'superadmin':
                case 'admin':
                    header("Location: admin/admindashboard.php");
                    break;
                case 'member':
                    header("Location: member/memberdashboard.php");
                    break;
                case 'editor':
                    header("Location: editor/editordashboard.php");
                    break;
                case 'accounting':
                    header("Location: accounting/accountingdashboard.php");
                    break;
                case 'applicant':
                    echo "Applicants cannot log in yet.";
                    exit();
                default:
                    echo "Unknown role.";
                    exit();
            }

            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
    $conn->close();
}
?>
