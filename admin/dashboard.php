<?php
include 'header.php';
include 'navbar.php';
include 'php/dashboard/dashboard_data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
<div class="content-container">

    <div class="card-container">
        <div class="card" onclick="window.location.href='reports.php?status=Active'" style="cursor:pointer;">
            <div class="icon"><i class="fas fa-user-check"></i></div>
            <div class="text-group">
                <div class="label">Active Members</div>
                <div class="count"><?= $activeMembers; ?></div>
            </div>
        </div>

        <div class="card" onclick="window.location.href='chapters.php'" style="cursor:pointer;">
            <div class="icon"><i class="fas fa-building"></i></div>
            <div class="text-group">
                <div class="label">PCP Chapters</div>
                <div class="count"><?= $pcpChapters; ?></div>
            </div>
        </div>

        <div class="card" onclick="window.location.href='events.php'" style="cursor:pointer;">
            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="text-group">
                <div class="label">Upcoming Events</div>
                <div class="count"><?= $eventsCount; ?></div>
            </div>
        </div>
    </div>

        <!-- Keep your User Record section below unchanged -->
        <h5 class="title">User Record</h5>
        <div class="userRecord-table">
            <div class="responsive-table">
                <table class="record-table desktop-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Membership No.</th>
                            <th>Name</th>
                            <th>Chapter</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Edited by</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12548796</td>
                            <td>20250123</td>
                            <td>JN Cueto</td>
                            <td>Pasay</td>
                            <td>2025-01-28</td>
                            <td>Active</td>
                            <td>20254000</td>
                        </tr>
                                        <tr>
                            <td>12548796</td>
                            <td>20250123</td>
                            <td>JN Cueto</td>
                            <td>Pasay</td>
                            <td>2025-01-28</td>
                            <td>Active</td>
                            <td>20254000</td>
                        </tr>
                                        <tr>
                            <td>12548796</td>
                            <td>20250123</td>
                            <td>JN Cueto</td>
                            <td>Pasay</td>
                            <td>2025-01-28</td>
                            <td>Active</td>
                            <td>20254000</td>
                        </tr>
                                        <tr>
                            <td>12548796</td>
                            <td>20250123</td>
                            <td>JN Cueto</td>
                            <td>Pasay</td>
                            <td>2025-01-28</td>
                            <td>Active</td>
                            <td>20254000</td>
                        </tr>
                                        <tr>
                            <td>12548796</td>
                            <td>20250123</td>
                            <td>JN Cueto</td>
                            <td>Pasay</td>
                            <td>2025-01-28</td>
                            <td>Active</td>
                            <td>20254000</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Mobile-style cards -->
                <div class="mobile-table">
                    <div class="record-card">
                        <div class="record-summary">
                            <strong>JN Cueto</strong>
                            <button class="toggle-details">Details</button>
                        </div>
                        <div class="record-details">
                            <p><strong>ID:</strong> 12548796</p>
                            <p><strong>Membership No.:</strong> 20250123</p>
                            <p><strong>Chapter:</strong> Pasay</p>
                            <p><strong>Date:</strong> 2025-01-28</p>
                            <p><strong>Edited by:</strong> 20254000</p>
                        </div>
                    </div>
                                <div class="record-card">
                        <div class="record-summary">
                            <strong>JN Cueto</strong>
                            <button class="toggle-details">Details</button>
                        </div>
                        <div class="record-details">
                            <p><strong>ID:</strong> 12548796</p>
                            <p><strong>Membership No.:</strong> 20250123</p>
                            <p><strong>Chapter:</strong> Pasay</p>
                            <p><strong>Date:</strong> 2025-01-28</p>
                            <p><strong>Edited by:</strong> 20254000</p>
                        </div>
                    </div>
                                <div class="record-card">
                        <div class="record-summary">
                            <strong>JN Cueto</strong>
                            <button class="toggle-details">Details</button>
                        </div>
                        <div class="record-details">
                            <p><strong>ID:</strong> 12548796</p>
                            <p><strong>Membership No.:</strong> 20250123</p>
                            <p><strong>Chapter:</strong> Pasay</p>
                            <p><strong>Date:</strong> 2025-01-28</p>
                            <p><strong>Edited by:</strong> 20254000</p>
                        </div>
                    </div>
                                <div class="record-card">
                        <div class="record-summary">
                            <strong>JN Cueto</strong>
                            <button class="toggle-details">Details</button>
                        </div>
                        <div class="record-details">
                            <p><strong>ID:</strong> 12548796</p>
                            <p><strong>Membership No.:</strong> 20250123</p>
                            <p><strong>Chapter:</strong> Pasay</p>
                            <p><strong>Date:</strong> 2025-01-28</p>
                            <p><strong>Edited by:</strong> 20254000</p>
                        </div>
                    </div>            <div class="record-card">
                        <div class="record-summary">
                            <strong>JN Cueto</strong>
                            <button class="toggle-details">Details</button>
                        </div>
                        <div class="record-details">
                            <p><strong>ID:</strong> 12548796</p>
                            <p><strong>Membership No.:</strong> 20250123</p>
                            <p><strong>Chapter:</strong> Pasay</p>
                            <p><strong>Date:</strong> 2025-01-28</p>
                            <p><strong>Edited by:</strong> 20254000</p>
                        </div>
                    </div>

                    <!-- Duplicate above block for each user -->
                </div>
            </div>
        </div>

</div>
<?php include '../footer.php'; ?>
</body>
</html>
