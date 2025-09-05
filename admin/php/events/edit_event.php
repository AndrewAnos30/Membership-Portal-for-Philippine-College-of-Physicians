<?php
include '../../../connection/conn.php';

if(isset($_POST['event_id'])) {
    $stmt = $conn->prepare("UPDATE events SET 
        event_title = ?, venue = ?, description = ?, event_date = ?, event_type = ?, fiscal_year = ?, event_host_type = ?, cpd_units = ?, event_host = ?, event_host_category = ?, hosted_by = ?
        WHERE event_id = ?");
    $stmt->bind_param(
        "sssssssissss",
        $_POST['event_title'],
        $_POST['venue'],
        $_POST['description'],
        $_POST['event_date'],
        $_POST['event_type'],
        $_POST['fiscal_year'],
        $_POST['event_host_type'],
        $_POST['cpd_units'],
        $_POST['event_host'],
        $_POST['event_host_category'],
        $_POST['hosted_by'],
        $_POST['event_id']
    );

    if($stmt->execute()) {
        echo "Event updated successfully.";
    } else {
        echo "Failed to update event.";
    }
}
?>
