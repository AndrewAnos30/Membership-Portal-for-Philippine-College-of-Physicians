<link rel="stylesheet" href="php/induction.css">
<?php
include '../connection/conn.php';

$limit = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$filter = isset($_GET['filter_membership']) ? trim($_GET['filter_membership']) : "";

// Build query
$where = "";
if ($filter != "") {
    $where = "WHERE i_membership_no LIKE '%" . $conn->real_escape_string($filter) . "%'";
}

// Count total
$total_sql = "SELECT COUNT(*) AS total FROM induction $where";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch with limit
$sql = "SELECT * FROM induction $where ORDER BY induc_date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<div class="table-wrapper">
    <table class="induction-table">
        <thead>
            <tr>
                <th>Membership Number</th>
                <th>Category</th>
                <th>Date</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['i_membership_no']}</td>
                            <td>{$row['induc_category']}</td>
                            <td>{$row['induc_date']}</td>
                            <td>{$row['remarks']}</td>
                            <td>
                                <i class='fa-solid fa-pen-to-square edit-btn'
                                   data-id='{$row['id']}'
                                   data-membership='{$row['i_membership_no']}'
                                   data-category='{$row['induc_category']}'
                                   data-date='{$row['induc_date']}'
                                   data-remarks='{$row['remarks']}'
                                   title='Edit'></i>
                                &nbsp;
                                <i class='fa-solid fa-trash delete-btn'
                                   data-id='{$row['id']}'
                                   data-membership='{$row['i_membership_no']}'
                                   title='Delete'></i>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination">
    <!-- Prev button -->
    <a href="?page=<?php echo max(1, $page-1); ?>&filter_membership=<?php echo urlencode($filter); ?>" 
       class="<?php echo ($page == 1) ? 'disabled' : ''; ?>">
       &laquo; Prev
    </a>

    <!-- Page numbers -->
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>&filter_membership=<?php echo urlencode($filter); ?>"
           class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <!-- Next button -->
    <a href="?page=<?php echo min($total_pages, $page+1); ?>&filter_membership=<?php echo urlencode($filter); ?>" 
       class="<?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
       Next &raquo;
    </a>
</div>

