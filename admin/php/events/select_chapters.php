<?php
// Include the database connection file
include('../connection/conn.php');

// Query to fetch chapter names from the 'chapters' table
$query = "SELECT chapter FROM chapters";
$result = mysqli_query($conn, $query);

// Start the select dropdown
echo '<div class="form-group">';
echo '<label for="event_host_category">Event Host Category</label>';
echo '<select id="event_host_category" name="event_host_category">';
echo '<option value="">Select Host Category</option>';  // Default option

// Check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and create an option for each chapter
    while ($row = mysqli_fetch_assoc($result)) {
        $chapter = $row['chapter'];
        echo "<option value=\"$chapter\">$chapter</option>";
    }
} else {
    // If no chapters are found in the database
    echo '<option value="">No Chapters Available</option>';
}

echo '</select>';
echo '</div>';
?>
