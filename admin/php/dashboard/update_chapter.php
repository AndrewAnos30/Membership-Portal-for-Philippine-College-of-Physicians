<?php
include __DIR__ . '/../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $chapter = trim($_POST['chapter'] ?? '');

    if ($id && $chapter !== '') {
        $stmt = $conn->prepare("UPDATE chapters SET chapter = ? WHERE id = ?");
        $stmt->bind_param("si", $chapter, $id);
        $stmt->execute();
        $stmt->close();
    }
}

header('Location: ../../chapters.php');
exit;
