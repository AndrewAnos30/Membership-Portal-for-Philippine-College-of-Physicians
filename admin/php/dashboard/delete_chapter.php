<?php
include __DIR__ . '/../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM chapters WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

header('Location: ../../chapters.php');
exit;
