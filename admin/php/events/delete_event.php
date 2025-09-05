<?php
include '../../../connection/conn.php';

if(isset($_POST['event_id'])) {
    $stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
    $stmt->bind_param("s", $_POST['event_id']);

    if($stmt->execute()) {
        echo "Event deleted successfully.";
    } else {
        echo "Failed to delete event.";
    }
}
?>
