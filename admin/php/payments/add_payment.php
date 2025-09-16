<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . "/../../../connection/conn.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date_of_payment = $_POST['date_of_payment'];
    $or_prefix       = $_POST['or_prefix'];
    $or_number       = $_POST['or_number'];
    $payor_type      = $_POST['payor_type'];
    $transaction_ref = $_POST['transaction_ref'] ?? null;
    $p_membership_no = $_POST['membership_no'] ?? null;
    $member_name     = $_POST['member_name'] ?? null;
    $payor_name      = $_POST['payor_name'] ?? null;
    $payment_location= $_POST['payment_location'] ?? null;
    $payment_mode    = $_POST['payment_mode'];
    $remarks         = $_POST['remarks'] ?? null;

    // Validation: required fields
    if (empty($date_of_payment) || empty($or_prefix) || empty($or_number) || empty($payor_type) || empty($payment_mode)) {
        $_SESSION['error'] = "Please fill all required fields.";
        header("Location: ../../payments.php");
        exit;
    }

    $sql = "INSERT INTO payments 
        (date_of_payment, or_prefix, or_number, payor_type, transaction_ref, 
         p_membership_no, member_name, payor_name, payment_location, payment_mode, remarks)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssss",
        $date_of_payment,
        $or_prefix,
        $or_number,
        $payor_type,
        $transaction_ref,
        $p_membership_no,
        $member_name,
        $payor_name,
        $payment_location,
        $payment_mode,
        $remarks
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = "Payment saved successfully!";
    } else {
        $_SESSION['error'] = "Database error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../../payments.php");
    exit;
}
?>
