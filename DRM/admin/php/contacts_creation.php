<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $mobile = $_POST['mobile'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO contacts 
        (con_membership_no, mobile, phone, email) 
        VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $member_no, $mobile, $phone, $email);

    if ($stmt->execute()) {
        header("Location: induction_creation.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
