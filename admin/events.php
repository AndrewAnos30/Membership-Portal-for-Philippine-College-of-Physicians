<?php 
include '../connection/conn.php';
include 'navbar.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Events</title>
<!-- CSS -->
<link rel="stylesheet" href="style/events.css">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="content-container">
  <div class="card">

    <!-- Tabs -->
    <ul class="tabs">
      <li class="active" data-tab="event-records">Event Records</li>
      <li data-tab="add-event">Add Event</li>
    </ul>

<!-- Event Records -->
<div id="event-records" class="tab-pane active">
  <div class="search-form">
    <form>
      <div class="field">
        <input type="text" id="filter-event" placeholder="Enter Event Code/No">
      </div>
      <button type="button" class="submit-search">Search</button>
      <button type="reset" class="btn-reset">Reset</button>
    </form>
  </div>

  <div class="table-wrapper">
    <table class="event-table">
      <thead>
        <tr>
          <th>Event Code</th>
          <th>Event Title</th>
          <th>CPD Units</th>
          <th>Event Date</th>
          <th>Hosted By</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          <?php include 'php/events/fetch_events.php'; ?>
      </tbody>
    </table>
  </div>
</div>


    <!-- Add Event -->
    <div id="add-event" class="tab-pane">
      <form class="event-form" action="php/events/create_event.php" method="POST">
        
        <div class="form-group">
            <label for="event_title">Event Title</label>
            <input type="text" id="event_title" name="event_title" placeholder="Enter Event Title" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="event_id">Event ID</label>
            <input type="text" id="event_id" name="event_id" readonly>
          </div>
          <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" placeholder="Enter Venue">
          </div>
        </div>

        <!-- Event Date, Fiscal Year -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="date" id="event_date" name="event_date" required>
          </div>
          <div class="form-group">
            <label for="fiscal_year">Fiscal Year</label>
            <input type="text" id="fiscal_year" name="fiscal_year" placeholder="2025-2026">
          </div>
        </div>

        <!-- Event Type, CPD Units -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_type">Event Type</label>
            <select id="event_type" name="event_type">
              <option value="">Select Event Type</option>
              <option>ANNUAL CONVENTION</option>
              <option>COMMUNITY ADVOCACY EVENT</option>
              <option>MEDICAL MISSION</option>
              <option>MIDYEAR CONVENTION</option>
              <option>OUTREACH PROGRAM</option>
              <option>PCP BUSINESS MEETING</option>
              <option>POSTGRADUATE COURSE</option>
              <option>ROUND TABLE DISCUSSION</option>
              <option>SCIENTIFIC FORUM</option>
              <option>SEMINAR</option>
              <option>SYMPOSIUM</option>
              <option>TRAINING COURSE</option>
              <option>WORKSHOP</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="cpd_units">PCP CPD Units</label>
            <input type="number" id="cpd_units" name="cpd_units" placeholder="0">
          </div>
        </div>

        <!-- Event Host, Hosted By -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_host">Event Host</label>
            <input type="text" id="event_host" name="event_host" placeholder="Enter Event Host">
          </div>
          <?php include("php/events/select_chapters.php"); ?>
        </div>

        <!-- Description -->
        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4" placeholder="Enter Event Description"></textarea>
        </div>

        <!-- Actions -->
        <div class="form-actions">
          <button type="reset" class="btn-reset">Clear</button>
          <button type="submit" class="btn-submit">Create Event</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Edit Event</h3>
      <form id="editEventForm" method="POST" action="php/events/edit_event.php">
          <!-- Event ID -->
          <div class="form-group">
              <label for="event_id">Event ID</label>
              <input type="text" id="event_id" name="event_id" readonly>
          </div>

          <!-- Event Title (full row) -->
          <div class="edit-form-row full-row">
              <div class="form-group">
                  <label for="event_title">Event Title</label>
                  <input type="text" id="event_title" name="event_title" required>
              </div>
          </div>

          <!-- Event Title + Venue -->
          <div class="edit-form-row">
              <div class="form-group">
                  <label for="event_title">Event Title</label>
                  <input type="text" id="event_title" name="event_title" required>
              </div>
              <div class="form-group">
                  <label for="venue">Venue</label>
                  <input type="text" id="venue" name="venue">
              </div>
          </div>

          <!-- Event Date + Fiscal Year -->
          <div class="edit-form-row">
              <div class="form-group">
                  <label for="event_date">Event Date</label>
                  <input type="date" id="event_date" name="event_date" required>
              </div>
              <div class="form-group">
                  <label for="fiscal_year">Fiscal Year</label>
                  <input type="text" id="fiscal_year" name="fiscal_year">
              </div>
          </div>

          <!-- Event Type + CPD Units -->
          <div class="edit-form-row">
              <div class="form-group">
                  <label for="event_type">Event Type</label>
                  <select id="event_type" name="event_type" required>
                      <option value="">Select Event Type</option>
                      <option>ANNUAL CONVENTION</option>
                      <option>COMMUNITY ADVOCACY EVENT</option>
                      <option>MEDICAL MISSION</option>
                      <option>MIDYEAR CONVENTION</option>
                      <option>OUTREACH PROGRAM</option>
                      <option>PCP BUSINESS MEETING</option>
                      <option>POSTGRADUATE COURSE</option>
                      <option>ROUND TABLE DISCUSSION</option>
                      <option>SCIENTIFIC FORUM</option>
                      <option>SEMINAR</option>
                      <option>SYMPOSIUM</option>
                      <option>TRAINING COURSE</option>
                      <option>WORKSHOP</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="cpd_units">CPD Units</label>
                  <input type="number" id="cpd_units" name="cpd_units">
              </div>
          </div>

          <!-- Event Host + Hosted By -->
          <div class="edit-form-row">
              <div class="form-group">
                  <label for="event_host">Event Host</label>
                  <input type="text" id="event_host" name="event_host">
              </div>
          <?php include("php/events/select_chapters.php"); ?>
          </div>

          <!-- Created At (readonly, full row) -->
          <div class="edit-form-row full-row">
              <div class="form-group">
                  <label for="created_at">Created At</label>
                  <input type="text" id="created_at" name="created_at" readonly>
              </div>
          </div>

                    <!-- Description (full row) -->
          <div class="edit-form-row full-row">
              <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" name="description" rows="3"></textarea>
              </div>
          </div>

          <!-- Actions -->
          <div class="form-actions">
              <button type="submit" class="btn-submit">Save</button>
              <button type="button" class="btn-reset close-btn">Cancel</button>
          </div>
      </form>
  </div>
</div>

<script>
  document.getElementById("event_type").addEventListener("change", function() {
    let eventType = this.value;

    if(eventType) {
        fetch("php/events/id_generator.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "event_type=" + encodeURIComponent(eventType)
        })
        .then(response => response.json())
        .then(data => {
            if(data.event_id) {
                document.getElementById("event_id").value = data.event_id;
            } else {
                alert("Error: " + data.error);
            }
        });
    } else {
        document.getElementById("event_id").value = "";
    }
});
</script>
<script>
$(document).ready(function() {
    // Initially hide the modals
    $('#editModal, #deleteModal').hide();
    // CLOSE MODALS
    $('.close, .close-btn').click(function() {
        $(this).closest('.modal').hide();
    });
});
</script>
<script>
$(document).ready(function() {
    // Edit button click
    $(".edit-btn").click(function() {
        const btn = $(this);
        $("#editEventForm #event_id").val(btn.data("id"));
        $("#editEventForm #event_title").val(btn.data("title"));
        $("#editEventForm #venue").val(btn.data("venue"));
        $("#editEventForm #description").val(btn.data("description"));
        $("#editEventForm #event_date").val(btn.data("date"));
        $("#editEventForm #event_type").val(btn.data("eventtype"));
        $("#editEventForm #fiscal_year").val(btn.data("fiscalyear"));
        $("#editEventForm #event_host_type").val(btn.data("hosttype"));
        $("#editEventForm #cpd_units").val(btn.data("cpd"));
        $("#editEventForm #event_host").val(btn.data("host"));
        $("#editEventForm #event_host_category").val(btn.data("hostcategory"));
        $("#editEventForm #hosted_by").val(btn.data("hostedby"));

        $("#editModal").show();
    });

    // Close modal
    $(".close, .close-btn").click(function() {
        $(this).closest(".modal").hide();
    });

    // Submit Edit form via AJAX
    $("#editEventForm").submit(function(e) {
        e.preventDefault();
        $.post("php/events/edit_event.php", $(this).serialize(), function(response) {
            alert(response);
            location.reload(); // refresh page after edit
        }).fail(function() {
            alert("Failed to update event.");
        });
    });

    // Delete button click
    $(".delete-btn").click(function() {
        const eventId = $(this).data("id");
        const eventCode = $(this).data("eventcode");

        if (confirm(`Are you sure you want to delete event ${eventCode}?`)) {
            $.post("php/events/delete_event.php", { event_id: eventId }, function(response) {
                alert(response);
                location.reload(); // refresh page after delete
            }).fail(function() {
                alert("Failed to delete event.");
            });
        }
    });
});
</script>

<script>
document.getElementById("filter-event").addEventListener("keyup", function() {
  let filter = this.value.toUpperCase();
  let rows = document.querySelectorAll(".event-table tbody tr");

  rows.forEach(row => {
    let eventCell = row.cells[0]; // first column = event code
    if (eventCell) {
      let txtValue = eventCell.textContent || eventCell.innerText;
      row.style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
    }
  });
});
</script>

<script>
$(document).ready(function(){
  $(".tabs li").click(function(){
    $(".tabs li").removeClass("active");
    $(this).addClass("active");

    $(".tab-pane").removeClass("active");
    $("#" + $(this).data("tab")).addClass("active");
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("filter-event");
  const searchBtn = document.querySelector(".submit-search");
  const resetBtn = document.querySelector(".btn-reset");
  const tableRows = document.querySelectorAll(".event-table tbody tr");

  // Function to filter rows
  function filterTable() {
    const filterValue = searchInput.value.toLowerCase().trim();

    tableRows.forEach(row => {
      const cells = row.querySelectorAll("td");
      const eventId       = cells[0]?.textContent.toLowerCase();
      const eventTitle    = cells[1]?.textContent.toLowerCase();
      const cpd           = cells[2]?.textContent.toLowerCase();
      const eventDate     = cells[3]?.textContent.toLowerCase();
      const hostedBy      = cells[4]?.textContent.toLowerCase();
      const description   = cells[5]?.textContent.toLowerCase();

      if (
        eventId.includes(filterValue) ||
        eventTitle.includes(filterValue) ||
        cpd.includes(filterValue) ||
        eventDate.includes(filterValue) ||
        hostedBy.includes(filterValue) ||
        description.includes(filterValue)
      ) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  // Search button click
  searchBtn.addEventListener("click", filterTable);

  // Reset button click
  resetBtn.addEventListener("click", function () {
    searchInput.value = "";
    tableRows.forEach(row => (row.style.display = ""));
  });

  // Live search
  searchInput.addEventListener("keyup", filterTable);
});
</script>

</body>
</html>
