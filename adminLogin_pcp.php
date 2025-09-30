<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin/dashboard.php");
    exit;
}

// Check for login error
$error_message = "";
if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Clear after showing
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | PCP</title>
    <link rel="stylesheet" href="css/adminLogin.css">

</head>
<body>

<div class="login-container">

    <form method="POST" action="process/admin_login_process.php">

        <!-- ERROR MESSAGE -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message" id="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <div class="field">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Philippine College of Physicians
    </div>
</div>

<script>
    // Fade out the error after 1.5 seconds
    window.addEventListener('DOMContentLoaded', (event) => {
        const error = document.getElementById('error-message');
        if (error) {
            setTimeout(() => {
                error.classList.add('fade-out');
            }, 1500); 
        }
    });
</script>

</body>
</html>
