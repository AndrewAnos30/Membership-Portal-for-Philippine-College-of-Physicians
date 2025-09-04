<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $extname = $_POST['extension'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $nationality = $_POST['nationality'];
    $civilstatus = $_POST['civilstatus'];
    $partners_name = $_POST['partners_name'];

    $stmt = $conn->prepare("INSERT INTO personal_info 
        (pi_membership_no, lastname, middlename, extname, gender, birthdate, nationality, civilstatus, partners_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $member_no, $lastname, $middlename, $extname, $gender, $dob, $nationality, $civilstatus, $partners_name);

    if ($stmt->execute()) {
        header("Location: membership-info_creation.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
