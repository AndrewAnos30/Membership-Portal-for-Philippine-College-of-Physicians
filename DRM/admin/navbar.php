<link rel="stylesheet" href="style/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<aside class="sidebar">
    <ul id="navList">
        <li><i class="fas fa-home"></i><span>Dashboard</span></li>
        <li><i class="fas fa-user"></i><span>Member</span></li>
        <li><i class="fas fa-graduation-cap"></i><span>Induction</span></li>
        <li><i class="fas fa-calendar-alt"></i><span>Event</span></li>
        <li><i class="fas fa-credit-card"></i><span>Payment</span></li>
        <li><i class="fas fa-chart-bar"></i><span>Report</span></li>
        <li><i class="fas fa-users-cog"></i><span>User</span></li>
    </ul>
</aside>




<!-- JavaScript for Click Active Behavior -->
<script>
    const navItems = document.querySelectorAll('#navList li');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
</script>
