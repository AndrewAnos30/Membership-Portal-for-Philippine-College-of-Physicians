<?php
// Include the database connection file
include('../connection/conn.php');

// Query to fetch chapter names from the 'chapters' table
$query = "SELECT chapter FROM chapters ORDER BY chapter ASC";
$result = mysqli_query($conn, $query);

// Start the select dropdown
echo '<div class="form-group">';
echo '<label for="hosted_by">Hosted By</label>';
echo '<select id="hosted_by" name="hosted_by" required>';
echo '<option value="">-- Select Chapter --</option>';  // Default option

// Check if the query returned any rows
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $chapter = htmlspecialchars($row['chapter']);
        echo "<option value=\"$chapter\">$chapter</option>";
    }
} else {
    echo '<option value="">No Chapters Available</option>';
}

echo '</select>';
echo '</div>';
?>
