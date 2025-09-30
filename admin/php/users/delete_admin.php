<?php
// Correct include path (2 levels up)
include '../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../users.php?error=invalid_request");
    exit;
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: ../../users.php?error=no_id");
    exit;
}

$id = intval($_POST['id']); // sanitize

// Fetch the username (used in related tables)
$stmt = $conn->prepare("SELECT username FROM admin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

if (!$username) {
    header("Location: ../../users.php?error=not_found");
    exit;
}

// Related tables that reference username
$tables = [
    'contacts'        => 'con_membership_no',
    'credentials'     => 'cre_membership_no',
    'home_address'    => 'a_membership_no',
    'induction'       => 'i_membership_no',
    'membership_info' => 'm_membership_no',
    'payments'        => 'p_membership_no',
    'personal_info'   => 'pi_membership_no'
];

$conn->begin_transaction();
try {
    foreach ($tables as $table => $fk) {
        $stmt = $conn->prepare("DELETE FROM `$table` WHERE `$fk` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
    }

    // Finally delete from account
    $stmt = $conn->prepare("DELETE FROM admin WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
    header("Location: ../../users.php?success=deleted");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../../users.php?error=" . urlencode($e->getMessage()));
    exit;
}
