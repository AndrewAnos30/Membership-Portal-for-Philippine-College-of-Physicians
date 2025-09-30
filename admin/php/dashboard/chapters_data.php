<?php
include '../connection/conn.php';

// Fetch chapters
$dataSql = "
    SELECT 
        c.id, 
        c.chapter, 
        COUNT(m.member_chapter) AS member_count
    FROM chapters c
    LEFT JOIN membership_info m 
        ON c.chapter = m.member_chapter
    GROUP BY c.id, c.chapter
    ORDER BY c.id ASC
";
$result = $conn->query($dataSql);

echo "<div class='table-wrapper'>";
echo "<table class='payment-table'>";
echo "<thead>
        <tr>
          <th>ID</th>
          <th>Chapter</th>
          <th>Count</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $chapter = htmlspecialchars($row['chapter']);

        echo "<tr>
                <td>$id</td>
                <td>
                    <span id='chapter-text-$id'>$chapter</span>
                    <form id='chapter-form-$id' method='POST' action='php/dashboard/update_chapter.php' style='display:none;'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='text' name='chapter' value='$chapter'>
                        <button type='submit' style='border:none;background:none;cursor:pointer;'>
                            <i class='fa fa-save' style='color:green;'></i>
                        </button>
                        <button type='button' onclick='cancelEdit($id)' style='border:none;background:none;cursor:pointer;'>
                            <i class='fa fa-times' style='color:red;'></i>
                        </button>
                    </form>
                </td>
                <td>".$row['member_count']."</td>
                <td>
                    <button onclick='enableEdit($id)' style='border:none;background:none;cursor:pointer;'>
                        <i class='fa fa-edit' style='color:#4F1713;'></i>
                    </button>
                    <form method='POST' action='php/dashboard/delete_chapter.php' style='display:inline;' onsubmit=\"return confirm('Are you sure you want to delete this chapter?');\">
                        <input type='hidden' name='id' value='$id'>
                        <button type='submit' style='border:none;background:none;cursor:pointer;'>
                            <i class='fa fa-trash' style='color:#4F1713;'></i>
                        </button>
                    </form>
                </td>
              </tr>";
    }
} else {
    echo "<tr class='no-data'><td colspan='4'>No chapters found</td></tr>";
}

echo "</tbody></table></div>";
?>

<script>
function enableEdit(id) {
    document.getElementById('chapter-text-' + id).style.display = 'none';
    document.getElementById('chapter-form-' + id).style.display = 'inline';
}

function cancelEdit(id) {
    document.getElementById('chapter-text-' + id).style.display = 'inline';
    document.getElementById('chapter-form-' + id).style.display = 'none';
}
</script>
