<?php
include '../../../connection/conn.php'; // your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $event_title = $_POST['event_title'];
    $venue = $_POST['venue'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_type = $_POST['event_type'];
    $fiscal_year = $_POST['fiscal_year'];
    $event_host_type = $_POST['event_host_type'];
    $cpd_units = $_POST['cpd_units'];
    $event_host = $_POST['event_host'];
    $event_host_category = $_POST['event_host_category'];
    $hosted_by = $_POST['hosted_by'];

    // Insert query
    $sql = "INSERT INTO events 
            (event_id, event_title, venue, description, event_date, event_type, fiscal_year, event_host_type, cpd_units, event_host, event_host_category, hosted_by)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisisss", 
        $event_id, $event_title, $venue, $description, $event_date, $event_type, $fiscal_year, $event_host_type, $cpd_units, $event_host, $event_host_category, $hosted_by
    );

    if ($stmt->execute()) {
        echo "<script>alert('Event created successfully!'); window.location.href='../../events.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
