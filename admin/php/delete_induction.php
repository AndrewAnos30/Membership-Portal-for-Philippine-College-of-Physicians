<?php
include '../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM induction WHERE id = ?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $stmt->close();
            header("Location: ../induction.php");
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        header("Location: ../induction.php");
        exit;
    }
}
?>
