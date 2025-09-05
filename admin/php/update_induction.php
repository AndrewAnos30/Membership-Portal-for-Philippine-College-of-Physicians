<?php
include '../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $category = $_POST['category'] ?? '';
    $date = $_POST['date'] ?? '';
    $remarks = $_POST['remarks'] ?? '';

    if ($id) {
        $stmt = $conn->prepare("UPDATE induction SET induc_category=?, induc_date=?, remarks=? WHERE id=?");
        $stmt->bind_param("sssi", $category, $date, $remarks, $id);

        if($stmt->execute()){
            $stmt->close();
            header("Location: ../induction.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        header("Location: ../induction.php");
        exit;
    }
}
?>
