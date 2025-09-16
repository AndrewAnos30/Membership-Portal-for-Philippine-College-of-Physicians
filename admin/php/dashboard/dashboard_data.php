<?php
// ============================
// dashboard_data.php
// ============================

include '../connection/conn.php';

// Fetch Active Members
$activeMembers = 0;
$sql = "SELECT COUNT(*) AS total FROM account";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $activeMembers = $row['total'];
}

// Fetch PCP Chapters
$pcpChapters = 0;
$sql = "SELECT COUNT(*) AS total FROM chapters";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $pcpChapters = $row['total'];
}

// Fetch Upcoming Events
$eventsCount = 0;
$sql = "SELECT COUNT(*) AS total FROM events WHERE event_date >= CURDATE()";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $eventsCount = $row['total'];
}

// Fetch User Records
$userRecords = [];
$sql = "SELECT id, membership_no, name, chapter, date, category, edited_by FROM account ORDER BY date DESC LIMIT 10"; // Adjust limit as needed
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $userRecords[] = $row;
    }
}
?>
