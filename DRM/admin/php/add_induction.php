<?php
include '../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $i_membership_no = $_POST['member_no'] ?? '';
    $induc_category  = $_POST['induction_category'] ?? '';
    $induc_date      = $_POST['induction_date'] ?? '';
    $remarks         = $_POST['remarks'] ?? '';

    if (!empty($i_membership_no) && !empty($induc_category) && !empty($induc_date)) {
        $stmt = $conn->prepare("INSERT INTO induction (i_membership_no, induc_category, induc_date, remarks) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $i_membership_no, $induc_category, $induc_date, $remarks);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ../induction.php?success=1");
            exit;
        } else {
            echo "Error inserting record: " . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>
