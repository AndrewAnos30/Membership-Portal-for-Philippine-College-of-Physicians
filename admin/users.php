<?php 
include '../connection/conn.php';
include 'navbar.php';
include 'header.php';

// Fetch current logged-in user (you might need to replace with $_SESSION if you have login system)
$current_user = "demo_user"; // example only
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management</title>
<link rel="stylesheet" href="style/users.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="content-container">
  <div class="card">
    <!-- Tabs -->
    <ul class="tabs">
      <li class="active" data-tab="profile">My Profile</li>
      <li data-tab="admin-list">Admin</li>
    </ul>

        <!-- Profile -->
        <div id="profile" class="tab-pane active">
            <form class="profile-form">
                <!-- Username -->
                <div class="form-group">
                <label for="profile_username">Username</label>
                <input type="text" id="profile_username" name="profile_username" value="demo_user">
                </div>

                <!-- Old Password -->
                <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" id="old_password" name="old_password">
                </div>

                <!-- New Password -->
                <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password">
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
                </div>

                <!-- Actions -->
                <div class="form-actions">
                <button type="submit" class="btn-submit">Update Profile</button>
                </div>
            </form>
        </div>
        <!-- Admins -->
        <div id="admin-list" class="tab-pane">
            <h3>Admins List</h3>
            <?php include "php/users/fetch_admin.php"; ?>
        </div>
  </div>
</div>

<script>
    $(document).ready(function(){
    // Tabs switcher
    $(".tabs li").click(function(){
        $(".tabs li").removeClass("active");
        $(this).addClass("active");

        $(".tab-pane").removeClass("active");
        $("#" + $(this).data("tab")).addClass("active");
    });
    });
</script>


</body>
</html>
