<?php
include '../connection/conn.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chapter = trim($_POST['chapter']);

    if (!empty($chapter)) {
        // Prevent duplicate chapters
        $check = $conn->prepare("SELECT id FROM chapters WHERE chapter = ?");
        $check->bind_param("s", $chapter);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<p style='color:red;'>Chapter already exists.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO chapters (chapter) VALUES (?)");
            $stmt->bind_param("s", $chapter);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>New chapter created successfully!</p>";
            } else {
                echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
            }

            $stmt->close();
        }

        $check->close();
    } else {
        echo "<p style='color:red;'>Please enter a chapter name.</p>";
    }
}
?>

<!-- Create Chapter Form -->
<form method="POST" class="event-form">
    <div class="form-row">
        <div class="form-group full-width">
            <label for="chapter">Chapter Name</label>
            <input type="text" id="chapter" name="chapter" required>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-submit">Create</button>
    </div>
</form>
