<?php
require_once __DIR__ . "/../../../connection/conn.php";

$sql = "SELECT chapter FROM chapters ORDER BY chapter ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['chapter']) . '">' . htmlspecialchars($row['chapter']) . '</option>';
    }
} else {
    echo '<option value="">No chapters found</option>';
}
?>
