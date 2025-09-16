<?php
include '../../../connection/conn.php';

if (isset($_POST['event_id'])) {
    $stmt = $conn->prepare("UPDATE events SET 
        event_title = ?, venue = ?, description = ?, event_date = ?, event_type = ?, fiscal_year = ?, cpd_units = ?, event_host = ?, hosted_by = ?
        WHERE event_id = ?");

    $stmt->bind_param(
        "ssssssisss",
        $_POST['event_title'],
        $_POST['venue'],
        $_POST['description'],
        $_POST['event_date'],
        $_POST['event_type'],
        $_POST['fiscal_year'],
        $_POST['cpd_units'],
        $_POST['event_host'],
        $_POST['hosted_by'],
        $_POST['event_id']
    );

    if ($stmt->execute()) {
        echo "Event updated successfully.";
    } else {
        echo "Failed to update event. Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
