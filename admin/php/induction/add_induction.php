<?php
include '../../connection/conn.php';

// Handle submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $i_membership_no = $_POST['member_no'] ?? '';
    $induc_category  = $_POST['induction_category'] ?? '';
    $induc_date      = $_POST['induction_date'] ?? '';
    $remarks         = $_POST['remarks'] ?? '';

    if (!empty($i_membership_no) && !empty($induc_category) && !empty($induc_date)) {
        $stmt = $conn->prepare("INSERT INTO induction (i_membership_no, induc_category, induc_date, remarks) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $i_membership_no, $induc_category, $induc_date, $remarks);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../induction.php?success=1");
            exit;
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

<!-- Add Induction Form -->
<div class="form-section">
    <form action="" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label>Membership Number</label>
                <select name="member_no" required>
                    <option value="">-- Select Membership Number --</option>
                    <?php
                    // Fetch usernames from account table
                    $sql = "SELECT username FROM account ORDER BY username ASC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['username']}'>{$row['username']}</option>";
                        }
                    } else {
                        echo "<option value=''>No members found</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="induction_category" required>
                    <option value="">-- Select Category --</option>
                    <option value="Diplomate">Diplomate</option>
                    <option value="Fellow Emeritus">Fellow Emeritus</option>
                    <option value="Honorary Fellow">Honorary Fellow</option>
                    <option value="Life Fellow">Life Fellow</option>
                    <option value="Life Member">Life Member</option>
                    <option value="Member">Member</option>
                    <option value="Regular Fellow">Regular Fellow</option>
                    <option value="Senior Fellow">Senior Fellow</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date Inducted</label>
                <input type="date" name="induction_date" required>
            </div>

            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks"></textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="reset" class="btn-reset">Clear</button>
            <button type="submit" class="btn-add">Add Record</button>
        </div>
    </form>
</div>
