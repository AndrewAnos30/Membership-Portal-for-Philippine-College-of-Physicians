<?php
include "../../../connection/conn.php"; // go up 3 levels to connection folder

if (isset($_GET['id'])) {
    $payment_id = intval($_GET['id']); // sanitize input

    $stmt = $conn->prepare("DELETE FROM payments WHERE payment_id = ?");
    $stmt->bind_param("i", $payment_id);

    if ($stmt->execute()) {
        header("Location: ../../payments.php?msg=deleted");
        exit();
    } else {
        header("Location: ../../payments.php?msg=error");
        exit();
    }
} else {
    header("Location: ../../payments.php?msg=invalid");
    exit();
}
