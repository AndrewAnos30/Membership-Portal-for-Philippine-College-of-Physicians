<?php 
include '../connection/conn.php';
include 'navbar.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Induction</title>
<!-- CSS -->
<link rel="stylesheet" href="style/induction.css">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- jQuery for modal popups -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add in your <head> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body>

<div class="content-container">

    <!-- CARD -->
    <div class="card">

        <!-- ADD INDUCTION FORM -->
        <div class="form-section">
            <form action="php/induction/add_induction.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Membership Number</label>
                        <select name="member_no" id="member_no" required>
                            <option value="">-- Select Membership Number --</option>
                            <?php
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

        <hr>

        <!-- INDUCTION TABLE -->
        <div class="table-header">
            <h3 style="flex:1;">Induction Records</h3>
            <form method="GET" action="" style="display:flex; align-items:center; gap:6px;">
                
                <div class="filter-input-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" 
                        name="filter_membership" 
                        placeholder="Filter by Membership No"
                        value="<?php echo isset($_GET['filter_membership']) ? htmlspecialchars($_GET['filter_membership']) : ''; ?>">
                </div>

                <button type="submit" class="btn-add">Search</button>

                <?php if (!empty($_GET['filter_membership'])): ?>
                    <a href="induction.php" class="btn-reset-filter">Clear</a>
                <?php endif; ?>
            </form>
        </div>


            <?php include 'php/induction/fetch_induction.php'; ?>
        </div>



    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Induction</h3>
        <form action="php/induction/update_induction.php" method="POST">
            <input type="hidden" name="id" id="edit-id">
            <div class="form-row">
                <div class="form-group">
                    <label>Membership No</label>
                    <input type="text" name="member_no" id="edit-membership" readonly>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" id="edit-category">
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
                    <input type="date" name="date" id="edit-date">
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea name="remarks" id="edit-remarks"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Save</button>
                <button type="button" class="btn-reset close-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Confirm Delete</h3>
        <form action="php/induction/delete_induction.php" method="POST">
            <p>Are you sure you want to delete the induction record of <span id="delete-membership-no"></span>?</p>
            <input type="hidden" name="id" id="delete-id">
            <div class="form-actions">
                <button type="submit" class="btn-accent">OK</button>
                <button type="button" class="btn-reset close-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){

    // OPEN EDIT MODAL
    $('.edit-btn').click(function(){
        $('#edit-id').val($(this).data('id'));
        $('#edit-membership').val($(this).data('membership'));
        $('#edit-category').val($(this).data('category'));
        $('#edit-date').val($(this).data('date'));
        $('#edit-remarks').val($(this).data('remarks'));
        $('#editModal').show();
    });

    // OPEN DELETE MODAL
    $('.delete-btn').click(function(){
        $('#delete-id').val($(this).data('id'));
        $('#delete-membership-no').text($(this).data('membership'));
        $('#deleteModal').show();
    });

    // CLOSE MODALS
    $('.close, .close-btn').click(function(){
        $(this).closest('.modal').hide();
    });

});
</script>
<script>
document.getElementById("filter-membership").addEventListener("keyup", function() {
    let filter = this.value.toUpperCase();
    let rows = document.querySelectorAll(".induction-table tbody tr");

    rows.forEach(row => {
        let membershipCell = row.cells[0]; // first column = membership no
        if (membershipCell) {
            let txtValue = membershipCell.textContent || membershipCell.innerText;
            row.style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('#member_no').select2({
        placeholder: "-- Select Membership Number --",
        allowClear: true
    });
});
</script>

</body>
</html>
