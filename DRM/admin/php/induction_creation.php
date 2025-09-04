<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $category = $_POST['category'];
    $date_inducted = $_POST['date_inducted'];
    $remarks = $_POST['remarks'];

    $stmt = $conn->prepare("INSERT INTO induction 
        (i_membership_no, induction_category, induc_date, remarks) 
        VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $member_no, $category, $date_inducted, $remarks);

    if ($stmt->execute()) {
        header("Location: address_creation.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
