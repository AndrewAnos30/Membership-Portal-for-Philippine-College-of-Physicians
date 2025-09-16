<?php
// Make sure $conn is available (if not, require it here)
if (!isset($conn)) {
    require_once __DIR__ . "/../../connection/conn.php";
}

$sql = "SELECT 
            payment_id,
            CONCAT(or_prefix, '-', or_number) AS or_full,
            p_membership_no,
            member_name,
            payor_name,
            payment_location,
            payment_mode,
            date_of_payment,
            remarks
        FROM payments
        ORDER BY date_of_payment DESC";

$result = $conn->query($sql);
?>

<div class="table-wrapper">
  <table class="payment-table">
    <thead>
      <tr>
        <th>OR #</th>
        <th>Member</th>
        <th>Payor</th>
        <th>Payment Mode</th>
        <th>Date of Payment</th>
        <th>Location</th>
        <th>Remarks</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['or_full']); ?></td>
            <td><?php echo htmlspecialchars($row['p_membership_no']); ?></td>
            <td><?php echo htmlspecialchars($row['payor_name']); ?></td>
            <td><?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $row['payment_mode']))); ?></td>
            <td><?php echo htmlspecialchars($row['date_of_payment']); ?></td>
            <td><?php echo htmlspecialchars($row['payment_location']); ?></td>
            <td><?php echo htmlspecialchars($row['remarks']); ?></td>
            <td>
              <a href="php/payments/delete_payment.php?id=<?php echo $row['payment_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" style="text-align:center;">No payments found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
