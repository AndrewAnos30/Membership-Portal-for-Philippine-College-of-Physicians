$(document).ready(function() {

    // ===========================
    // MODAL VARIABLES
    // ===========================
    const editModal = $('#editModal');
    const deleteModal = $('#deleteModal');

    // ===========================
    // OPEN EDIT MODAL
    // ===========================
    $('.edit-btn').on('click', function() {
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        const membership = row.find('td:eq(0)').text();
        const category = row.find('td:eq(1)').text();
        const date = row.find('td:eq(2)').text();
        const remarks = row.find('td:eq(3)').text();

        $('#edit-id').val(id);
        $('#edit-membership').val(membership);
        $('#edit-category').val(category);
        $('#edit-date').val(date);
        $('#edit-remarks').val(remarks);

        editModal.fadeIn();
    });

    // ===========================
    // OPEN DELETE MODAL
    // ===========================
    $('.delete-btn').on('click', function() {
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        const membership = row.find('td:eq(0)').text();

        $('#delete-id').val(id);
        $('#delete-membership').val(membership); // hidden input
        $('#delete-membership-no').text(membership); // show in modal

        deleteModal.fadeIn();
    });

    // ===========================
    // CLOSE MODALS
    // ===========================
    $('.modal .close').on('click', function() {
        $(this).closest('.modal').fadeOut();
    });

    // ===========================
    // SAVE EDIT (AJAX)
    // ===========================
    $('#save-edit').on('click', function() {
        const id = $('#edit-id').val();
        const membership = $('#edit-membership').val();
        const category = $('#edit-category').val();
        const date = $('#edit-date').val();
        const remarks = $('#edit-remarks').val();

        if(category && date){
            $.ajax({
                url: 'update_induction.php',
                type: 'POST',
                data: {id, membership, category, date, remarks},
                success: function(response){
                    location.reload(); // reload table after edit
                },
                error: function(){
                    alert('Failed to update record.');
                }
            });
        } else {
            alert('Category and Date are required!');
        }
    });

    // ===========================
    // CONFIRM DELETE (AJAX)
    // ===========================
    $('#confirm-delete').on('click', function() {
        const id = $('#delete-id').val();
        const membership = $('#delete-membership').val();

        $.ajax({
            url: 'delete_induction.php',
            type: 'POST',
            data: {id, membership},
            success: function(response){
                location.reload(); // reload after delete
            },
            error: function(){
                alert('Failed to delete record.');
            }
        });
    });

    // ===========================
    // ADD RECORD (AJAX)
    // ===========================
    $('.btn-add').on('click', function() {
        const membership = $('#member-no').val();
        const category = $('#induction-category').val();
        const date = $('#induction-date').val();
        const remarks = $('#induction-remarks').val();

        if(category && date){
            $.ajax({
                url: 'add_induction.php',
                type: 'POST',
                data: {membership, category, date, remarks},
                success: function(response){
                    location.reload(); // reload table after add
                },
                error: function(){
                    alert('Failed to add record.');
                }
            });
        } else {
            alert('Category and Date are required!');
        }
    });

});
