<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forgotpassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <a href="index.php" class="close-button">
            <i class="fas fa-times"></i>
        </a>

        <div class="form-container">
            <form class="forgotForm" action="">
                <label for="email">Enter your registered email address:</label>
                <input type="email" name="email" id="email" placeholder="e.g. user@example.com" required>
                
                <input type="submit" class="forgotbtn" value="Send Reset Link">
            </form>

            <div class="info-text">
                Forgot your password? Enter your email and we’ll send a link to reset it.<br>
                For inquiries, contact <a href="mailto:support@example.com">support@example.com</a>
            </div>
        </div>
    </div>
</body>
</html>