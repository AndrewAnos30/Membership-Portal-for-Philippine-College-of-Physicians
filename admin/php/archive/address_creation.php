<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_no = $_SESSION['member_no'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $zip = $_POST['zip'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    $stmt = $conn->prepare("INSERT INTO home_address 
        (a_membership_no, region, province, city, barangay, zip, address1, address2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $member_no, $region, $province, $city, $barangay, $zip, $address1, $address2);

    if ($stmt->execute()) {
        // Final step
        unset($_SESSION['member_no']); // cleanup
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
