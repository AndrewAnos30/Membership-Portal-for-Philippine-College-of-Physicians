<?php 
include '../connection/conn.php';
include 'navbar.php';
include 'header.php';

// Fetch current logged-in user (replace if you have session auth)
$current_user = "demo_user"; // example only
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chapters</title>
<link rel="stylesheet" href="style/users.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="content-container">
  <div class="card">
    <!-- Tabs -->
    <ul class="tabs">
      <li class="active" data-tab="admin-list">Chapters</li>
      <li data-tab="create-chapter">Create Chapter</li>
    </ul>

    <!-- Chapters list -->
    <div id="admin-list" class="tab-pane active">
      <!-- Search form -->
      <div class="search-form">
        <form onsubmit="return false;">
          <div class="field">
            <input type="text" id="filter-chapter" placeholder="Enter Chapter Name">
          </div>
          <button type="button" class="submit-search" onclick="filterChapters()">Search</button>
          <button type="reset" class="btn-reset" onclick="resetFilter()">Reset</button>
        </form>
      </div>

      <!-- Table -->
      <div id="chapter-table">
        <?php include "php/dashboard/chapters_data.php"; ?>
      </div>
    </div>

    <!-- Create Chapter tab -->
    <div id="create-chapter" class="tab-pane">
      <?php include "php/dashboard/create_chapter.php"; ?>
    </div>
  </div>
</div>

<script>
// Tab switching
document.querySelectorAll(".tabs li").forEach(tab => {
  tab.addEventListener("click", function() {
    document.querySelectorAll(".tabs li").forEach(t => t.classList.remove("active"));
    document.querySelectorAll(".tab-pane").forEach(pane => pane.classList.remove("active"));
    this.classList.add("active");
    document.getElementById(this.getAttribute("data-tab")).classList.add("active");
  });
});

// Filter chapters
function filterChapters() {
    let input = document.getElementById("filter-chapter").value.toLowerCase();
    let rows = document.querySelectorAll("#chapter-table table tbody tr");

    rows.forEach(row => {
        let chapterCell = row.querySelector("td:nth-child(2)");
        if (!chapterCell) return;

        let chapterText = chapterCell.textContent.toLowerCase();
        row.style.display = chapterText.includes(input) ? "" : "none";
    });
}

function resetFilter() {
    document.getElementById("filter-chapter").value = "";
    let rows = document.querySelectorAll("#chapter-table table tbody tr");
    rows.forEach(row => row.style.display = "");
}
</script>

</body>
</html>
