<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $chapter = $_POST['chapter'];
    $category = $_POST['category'];
    $specialty = $_POST['specialty'];
    $sub_specialty = $_POST['sub_specialty'];
    $other_specialty = $_POST['other_specialty'];
    $classification = $_POST['classification'];
    $member_status = $_POST['member_status'];

    $stmt = $conn->prepare("INSERT INTO membership_info 
        (m_membership_no, member_chapter, member_category, specialty, sub_specialty, other_specialty, classification, member_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $member_no, $chapter, $category, $specialty, $sub_specialty, $other_specialty, $classification, $member_status);

    if ($stmt->execute()) {
        header("Location: credentials_creation.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
