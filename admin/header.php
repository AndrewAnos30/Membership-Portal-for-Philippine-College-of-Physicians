<link rel="stylesheet" href="style/header.css">
<link rel="stylesheet" href="../css/footer.css">

<header>
    <div class="left-container">
        <div class="logo-container">
            <img src="../img/headerlogo.png" alt="Logo" class="logo">
        </div>
    </div>

    <div class="right-container">
        <div class="profile-dropdown">
            <img src="../img/user.png" alt="Profile" class="profile-img" id="profileToggle">
            <div class="dropdown" id="profileDropdown">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
    </div>
</header>


    <script>
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');

    profileToggle.addEventListener('click', () => {
        profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Optional: close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileToggle.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.style.display = 'none';
        }
    });
</script>

