<?php
include '../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../users.php?error=invalid_request");
    exit;
}

if (empty($_POST['id'])) {
    header("Location: ../../users.php?error=no_id");
    exit;
}

$id = intval($_POST['id']);
$new_username = trim($_POST['username'] ?? '');  // Using 'username' as the field for membership
$new_role = trim($_POST['role'] ?? '');
$new_password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Fetch old values
$stmt = $conn->prepare("SELECT username, role FROM admin WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($old_username, $old_role);
$stmt->fetch();
$stmt->close();

if (!$old_username) {
    header("Location: ../../users.php?error=not_found");
    exit;
}

$conn->begin_transaction();
try {
    // Disable foreign key checks temporarily
    $conn->query("SET foreign_key_checks = 0;");

    // ---- If username changed, update related tables first ----
    if (!empty($new_username) && $new_username !== $old_username) {
        $tables = [
            'contacts'        => 'con_membership_no',
            'credentials'     => 'cre_membership_no',
            'home_address'    => 'a_membership_no',
            'induction'       => 'i_membership_no',
            'membership_info' => 'm_membership_no',
            'payments'        => 'p_membership_no',
            'personal_info'   => 'pi_membership_no'
        ];

        foreach ($tables as $table => $fk) {
            $stmt = $conn->prepare("UPDATE `$table` SET `$fk`=? WHERE `$fk`=?");
            $stmt->bind_param("ss", $new_username, $old_username);
            $stmt->execute();
            $stmt->close();
        }
    }

    // ---- Update account table ----
    $sql = "UPDATE admin SET username=?, role=?";
    $types = "ssi";
    $params = [$new_username ?: $old_username, $new_role ?: $old_role, $id];

    if (!empty($new_password)) {
        if ($new_password !== $confirm_password) {
            header("Location: ../../users.php?error=password_mismatch");
            exit;
        }
        $hashed = password_hash($new_password, PASSWORD_BCRYPT);
        $sql = "UPDATE admin SET username=?, role=?, password=? WHERE id=?";
        $types = "sssi";
        $params = [$new_username ?: $old_username, $new_role ?: $old_role, $hashed, $id];
    } else {
        $sql .= " WHERE id=?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->close();

    // Commit changes
    $conn->commit();

    // Re-enable foreign key checks
    $conn->query("SET foreign_key_checks = 1;");

    header("Location: ../../users.php?success=updated");
    exit;
} catch (Exception $e) {
    // Rollback changes if any error occurs
    $conn->rollback();

    // Re-enable foreign key checks in case of error
    $conn->query("SET foreign_key_checks = 1;");

    header("Location: ../../users.php?error=" . urlencode($e->getMessage()));
    exit;
}
