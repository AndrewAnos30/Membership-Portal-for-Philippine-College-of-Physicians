<?php
include '../connection/conn.php';

// Fetch all events without any filters or pagination
$sql = "SELECT event_id, event_title, venue, description, event_date, event_type, fiscal_year, event_host_type, cpd_units, event_host, event_host_category, hosted_by 
        FROM events";

$stmt = $conn->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['event_id']}</td>
                <td>{$row['event_title']}</td>
                <td>{$row['cpd_units']}</td>
                <td>{$row['event_date']}</td>
                <td>{$row['hosted_by']}</td>
                <td>{$row['description']}</td>
                <td>
                    <button class='edit-btn'
                        data-id='{$row['event_id']}'
                        data-eventcode='{$row['event_id']}'
                        data-title='{$row['event_title']}'
                        data-venue='{$row['venue']}'
                        data-description='{$row['description']}'
                        data-date='{$row['event_date']}'
                        data-eventtype='{$row['event_type']}'
                        data-fiscalyear='{$row['fiscal_year']}'
                        data-hosttype='{$row['event_host_type']}'
                        data-cpd='{$row['cpd_units']}'
                        data-host='{$row['event_host']}'
                        data-hostcategory='{$row['event_host_category']}'
                        data-hostedby='{$row['hosted_by']}'>Edit</button>
                    <button class='delete-btn'
                        data-id='{$row['event_id']}'
                        data-eventcode='{$row['event_id']}'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No events found</td></tr>";
}

$conn->close();
?>
