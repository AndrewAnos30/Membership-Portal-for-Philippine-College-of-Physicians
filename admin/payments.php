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
<link rel="stylesheet" href="style/payments.css">
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
        
        <!-- Event ID -->
        <div class="form-group">
          <label for="event_id">Event ID</label>
          <input type="text" id="event_id" name="event_id" placeholder="EVT-2025-001" required>
        </div>

        <!-- Event Title -->
        <div class="form-group">
          <label for="event_title">Event Title</label>
          <input type="text" id="event_title" name="event_title" placeholder="Enter Event Title" required>
        </div>

        <!-- Venue & Date -->
        <div class="form-row">
          <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" id="venue" name="venue" placeholder="Enter Venue">
          </div>
          <div class="form-group">
            <label for="event_date">Event Date</label>
            <input type="date" id="event_date" name="event_date" required>
          </div>
        </div>

        <!-- Event Type & Fiscal Year -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_type">Event Type</label>
            <select id="event_type" name="event_type">
              <option value="">Select Event Type</option>
              <option>Conference</option>
              <option>Seminar</option>
              <option>Workshop</option>
              <option>Webinar</option>
            </select>
          </div>
          <div class="form-group">
            <label for="fiscal_year">Fiscal Year</label>
            <input type="text" id="fiscal_year" name="fiscal_year" placeholder="2025">
          </div>
        </div>

        <!-- Event Host Type & CPD Units -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_host_type">Event Host Type</label>
            <select id="event_host_type" name="event_host_type">
              <option value="">Select Host Type</option>
              <option>PCP Chapter</option>
              <option>Specialty Division</option>
              <option>Partner Organization</option>
            </select>
          </div>
          <div class="form-group">
            <label for="cpd_units">PCP CPD Units</label>
            <input type="number" id="cpd_units" name="cpd_units" placeholder="0">
          </div>
        </div>

        <!-- Event Host & Host Category -->
        <div class="form-row">
          <div class="form-group">
            <label for="event_host">Event Host</label>
            <input type="text" id="event_host" name="event_host" placeholder="Enter Event Host">
          </div>
          <div class="form-group">
            <label for="event_host_category">Event Host Category</label>
            <select id="event_host_category" name="event_host_category">
              <option value="">Select Host Category</option>
              <option>National</option>
              <option>Regional</option>
              <option>Local</option>
            </select>
          </div>
        </div>

        <!-- Hosted By -->
        <div class="form-group">
          <label for="hosted_by">Hosted By</label>
          <input type="text" id="hosted_by" name="hosted_by" placeholder="Enter Hosted By">
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
    <form>
      <input type="hidden" id="edit-id">
      <div class="form-row">
        <div class="form-group">
          <label>Event Code</label>
          <input type="text" id="edit-eventcode" readonly>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select id="edit-category">
            <option value="">-- Select Category --</option>
            <option value="Conference">Conference</option>
            <option value="Seminar">Seminar</option>
            <option value="Workshop">Workshop</option>
            <option value="Training">Training</option>
            <option value="Meeting">Meeting</option>
          </select>
        </div>
        <div class="form-group">
          <label>Date</label>
          <input type="date" id="edit-date">
        </div>
        <div class="form-group">
          <label>Remarks</label>
          <textarea id="edit-remarks"></textarea>
        </div>
      </div>
      <div class="form-actions">
        <button type="button" class="btn-submit">Save</button>
        <button type="button" class="btn-reset close-btn">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Confirm Delete</h3>
    <p>Are you sure you want to delete the event record of <span id="delete-event-code"></span>?</p>
    <input type="hidden" id="delete-id">
    <div class="form-actions">
      <button type="button" class="btn-accent">OK</button>
      <button type="button" class="btn-reset close-btn">Cancel</button>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

  // OPEN EDIT MODAL
  $('.edit-btn').click(function(){
    $('#edit-id').val($(this).data('id'));
    $('#edit-eventcode').val($(this).data('eventcode'));
    $('#edit-category').val($(this).data('category'));
    $('#edit-date').val($(this).data('date'));
    $('#edit-remarks').val($(this).data('remarks'));
    $('#editModal').show();
  });

  // OPEN DELETE MODAL
  $('.delete-btn').click(function(){
    $('#delete-id').val($(this).data('id'));
    $('#delete-event-code').text($(this).data('eventcode'));
    $('#deleteModal').show();
  });

  // CLOSE MODALS
  $('.close, .close-btn').click(function(){
    $(this).closest('.modal').hide();
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
