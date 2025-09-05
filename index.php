<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Doctor's Relationship Management</title>
</head>

<body>


    <div class="main-container">

        <div class="left">
           
                <div class="form-header">
                    <img src="img/logo.png" alt="">
                    <h2 style="color: #531a14; font-weight: 600; margin-top: 10px;">Membership Profile</h2>
                </div>

                <div class="welcome-message">
                    <h1> Login</h1>
                </div>
            <form id="LoginForm" action="login.php" method="post">

                <div class="field">
                    <input type="text" name="username" class="username" placeholder="Member Id." required>
                </div>
<div class="field password-field">
    <input type="password" name="password" class="password" placeholder="Password" required id="password">
    <i class="fa-solid fa-eye" id="togglePassword"></i>
</div>

                <div class="field">
                    <input type="submit" name="submit" class="login-btn">
                </div>
            </form>
            <div class="form-footer">
                <a href="forgotPassword.php" class="forgot-password">Forgot password?</a>
                <p class="inquiries">
                    For inquiries, contact <a href="mailto:support@example.com">support@example.com</a>
                </p>
            </div>
                     
        </div>

        <div class="right">
            <div class="right-content">
                <div class="right-header">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="right-body">
                    Membership Profile
                </div>
            </div>
        </div>
    </div>

</body>
    <?php include 'footer.php'; ?>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the eye / eye-slash icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>