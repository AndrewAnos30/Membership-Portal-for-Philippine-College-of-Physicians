<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $prc = $_POST['prc'];
    $prc_expiry = $_POST['prc_expiry'];
    $pma = $_POST['pma'];
    $pma_expiry = $_POST['pma_expiry'];
    $phic = $_POST['phic'];
    $phic_expiry = $_POST['phic_expiry'];

    $stmt = $conn->prepare("INSERT INTO credentials 
        (cre_membership_no, prc, prc_expiry, pma, pma_expiry, phic, phic_expiry) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $member_no, $prc, $prc_expiry, $pma, $pma_expiry, $phic, $phic_expiry);

    if ($stmt->execute()) {
        header("Location: contacts_creation.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
