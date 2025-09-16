<?php
include '../connection/conn.php';

// Fetch only admin and superadmin accounts
$sql = "SELECT id, username AS membership_no, role FROM account WHERE role IN ('admin', 'superadmin') ORDER BY role DESC";
$result = $conn->query($sql);
?>

<div class="table-wrapper">
  <table class="payment-table">
    <thead>
      <tr>
        <th style="width: 60px;">#</th>
        <th>Membership No</th>
        <th>Role</th>
        <th style="width: 160px; text-align:center;">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php $count = 1; ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $count++; ?></td>
            <td><?= htmlspecialchars($row['membership_no']); ?></td>
            <td><?= ucfirst(htmlspecialchars($row['role'])); ?></td>
            <td style="text-align:center;">

              <!-- Edit Button (still modal) -->
              <button class="edit-btn"
                      type="button"
                      data-id="<?= $row['id']; ?>"
                      data-membership="<?= htmlspecialchars($row['membership_no']); ?>"
                      data-role="<?= htmlspecialchars($row['role']); ?>">
                Edit
              </button>

              <!-- Delete Form (pure PHP, no JS) -->
              <form action="php/users/delete_admin.php" method="POST" style="display:inline;" 
                    onsubmit="return confirm('Are you sure you want to delete <?= htmlspecialchars($row['membership_no']); ?>?');">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <button type="submit" class="delete-btn">Delete</button>
              </form>

            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="4" style="text-align:center; color:#666;">No admins found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Edit Admin</h3>
    <!-- Direct PHP form (no AJAX) -->
        <form id="editForm" method="POST" action="php/users/edit_admin.php">
        <input type="hidden" id="edit_id" name="id">

        <div class="form-group">
            <label for="edit_username">Username</label>
            <input type="text" id="edit_username" name="username" required>
        </div>

        <div class="form-group">
            <label for="edit_role">Role</label>
            <select id="edit_role" name="role" required>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label for="edit_password">New Password</label>
            <input type="password" id="edit_password" name="password">
        </div>

        <div class="form-group">
            <label for="edit_confirm_password">Confirm Password</label>
            <input type="password" id="edit_confirm_password" name="confirm_password">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Save Changes</button>
        </div>
        </form>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
  // ===== OPEN EDIT MODAL =====
  document.querySelectorAll(".edit-btn").forEach(btn => {
    btn.addEventListener("click", function() {
      document.getElementById("edit_id").value = this.dataset.id;
      document.getElementById("edit_username").value = this.dataset.membership;
      document.getElementById("edit_role").value = this.dataset.role;
      document.getElementById("edit_password").value = "";
      document.getElementById("edit_confirm_password").value = "";

      const modal = document.getElementById("editModal");
      modal.style.display = "block";
      setTimeout(() => modal.classList.add("show"), 10);
    });
  });

  // ===== CLOSE MODAL =====
  document.querySelectorAll(".modal .close").forEach(closeBtn => {
    closeBtn.addEventListener("click", function() {
      const modal = this.closest(".modal");
      modal.classList.remove("show");
      setTimeout(() => modal.style.display = "none", 300);
    });
  });

  // Close when clicking outside modal
  window.addEventListener("click", function(e) {
    document.querySelectorAll(".modal").forEach(modal => {
      if (e.target === modal) {
        modal.classList.remove("show");
        setTimeout(() => modal.style.display = "none", 300);
      }
    });
  });
});
</script>
