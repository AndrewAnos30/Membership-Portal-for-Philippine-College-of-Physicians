<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/dashboard.css">
    <title>Dashboard</title>
</head>

  <?php include 'header.php'; ?>
  <?php include 'navbar.php'; ?>

<body>
    <div class="content-container">

    <div class="card-container">
    <div class="card">
        <div class="icon">
            <i class="fas fa-user-check"></i>
        </div>
        <div class="text-group">
            <div class="label">Active Members</div>
            <div class="count">300</div>
        </div>
    </div>

    <div class="card">
        <div class="icon">
            <i class="fas fa-building"></i>
        </div>
        <div class="text-group">
            <div class="label">PCP Chapters</div>
            <div class="count">300</div>
        </div>
    </div>

    <div class="card">
        <div class="icon">
            <i class="fas fa-id-badge"></i>
        </div>
        <div class="text-group">
            <div class="label">PRC Licenses</div>
            <div class="count">300</div>
        </div>
    </div>

    <div class="card">
        <div class="icon">
            <i class="fas fa-notes-medical"></i>
        </div>
        <div class="text-group">
            <div class="label">PhilHealth Licenses</div>
            <div class="count">300</div>
        </div>
    </div>
    </div>

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

          <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div>
</body>


  <?php include '../footer.php'; ?>
  <script>
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', () => {
            const card = button.closest('.record-card');
            card.classList.toggle('active');
            button.textContent = card.classList.contains('active') ? 'Hide' : 'Details';
        });
    });
</script>

</html>
