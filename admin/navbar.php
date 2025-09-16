<link rel="stylesheet" href="style/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<aside class="sidebar">
    <ul id="navList">
        <li data-link="dashboard"><i class="fas fa-home"></i><span>Dashboard</span></li>
        <li data-link="members"><i class="fas fa-user"></i><span>Member</span></li>
        <li data-link="induction"><i class="fas fa-graduation-cap"></i><span>Induction</span></li>
        <li data-link="events"><i class="fas fa-calendar-alt"></i><span>Event</span></li>
        <li data-link="payments"><i class="fas fa-credit-card"></i><span>Payment</span></li>
        <li data-link="reports"><i class="fas fa-chart-bar"></i><span>Report</span></li>
        <li data-link="users"><i class="fas fa-users-cog"></i><span>User</span></li>
    </ul>
</aside>





<!-- JavaScript for Click Active Behavior -->
<script>
const navItems = document.querySelectorAll('#navList li');

// Get the current page name from the URL (without extension)
const currentPage = window.location.pathname.split('/').pop().split('.').shift();

// Add active class to the corresponding sidebar item based on the current page
navItems.forEach(item => {
    const page = item.getAttribute('data-link');

    // Check if the sidebar item matches the current page
    if (page === currentPage) {
        item.classList.add('active');
    }

    // Add click event listener to each sidebar item
    item.addEventListener('click', () => {
        // Remove active class from all items
        navItems.forEach(i => i.classList.remove('active'));
        
        // Add active class to the clicked item
        item.classList.add('active');

        // Redirect to the page associated with the clicked item
        window.location.href = `${page}.php`; // Navigate to page (e.g., dashboard.php, member.php)
    });
});

</script>
