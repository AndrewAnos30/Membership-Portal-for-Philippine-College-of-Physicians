<?php
include '../../../connection/conn.php';

// Function: Map event type to prefix
function getEventPrefix($eventType) {
    $map = [
        "ANNUAL CONVENTION"       => "ANC",
        "COMMUNITY ADVOCACY EVENT"=> "CAE",
        "MEDICAL MISSION"         => "MDM",
        "MIDYEAR CONVENTION"      => "MYC",
        "OUTREACH PROGRAM"        => "OTP",
        "PCP BUSINESS MEETING"    => "PBM",
        "POSTGRADUATE COURSE"     => "PGC",
        "ROUND TABLE DISCUSSION"  => "RTD",
        "SCIENTIFIC FORUM"        => "SCF",
        "SEMINAR"                 => "SEM",
        "SYMPOSIUM"               => "SYM",
        "TRAINING COURSE"         => "TRC",
        "WORKSHOP"                => "WSP"
    ];
    return isset($map[$eventType]) ? $map[$eventType] : "EVT"; // default fallback
}

// Function: Generate unique event_id
function generateEventId($conn, $eventType) {
    $prefix = getEventPrefix($eventType);

    do {
        $number = str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
        $eventId = $prefix . "-" . $number;

        // Check uniqueness
        $stmt = $conn->prepare("SELECT COUNT(*) FROM events WHERE event_id = ?");
        $stmt->bind_param("s", $eventId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    } while ($count > 0);

    return $eventId;
}

// Handle request
if (isset($_POST['event_type'])) {
    $eventType = $_POST['event_type'];
    $eventId   = generateEventId($conn, $eventType);

    echo json_encode(["event_id" => $eventId]);
} else {
    echo json_encode(["error" => "No event type provided"]);
}
