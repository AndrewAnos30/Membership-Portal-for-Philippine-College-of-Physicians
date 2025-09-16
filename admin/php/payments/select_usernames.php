<?php
include "../../../connection/conn.php";

$sql_users = "SELECT username FROM account";
$result_users = $conn->query($sql_users);

if ($result_users && $result_users->num_rows > 0) {
    while ($row = $result_users->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['username']) . '">' 
             . htmlspecialchars($row['username']) . '</option>';
    }
} else {
    echo '<option value="">No users found</option>';
}
