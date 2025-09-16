<?php 
include '../connection/conn.php';

// Fetch usernames from accounts table
$sql = "SELECT username FROM account";
$result = $conn->query($sql);
include 'navbar.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>payments</title>
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
      <li class="active" data-tab="event-records">Payment Records</li>
      <li data-tab="add-payment">Add Payment</li>
    </ul>

    <!-- payment Records -->
    <div id="event-records" class="tab-pane active">
      <div class="search-form">
        <form>
          <div class="field">
            <input type="text" id="filter-payment" placeholder="Enter payment Code/No">
          </div>
          <button type="button" class="submit-search">Search</button>
          <button type="reset" class="btn-reset">Reset</button>
        </form>
      </div>
      
      <?php include "php/payments/payments_list.php"; ?>

    </div>

<!-- Add Payment -->
<div id="add-payment" class="tab-pane">
  <form class="payment-form" action="php/payments/add_payment.php" method="POST">
    <div class="form-row">
      <div class="form-group">
        <label for="date_of_payment">Date of Payment</label>
        <input type="date" id="date_of_payment" name="date_of_payment" required>
      </div>
      <div class="form-group">
        <label>Official Receipt (OR) No.</label>
        <div class="or-wrapper">
          <!-- Prefix dropdown -->
          <select id="or_prefix" name="or_prefix" required>
            <option value="">Select</option>
            <option value="PCP">PCP</option>
            <option value="ABC">ABC</option>
            <option value="XYZ">XYZ</option>
          </select>

          <!-- Number input -->
          <input type="text" id="or_number" name="or_number" placeholder="123456" pattern="[0-9]*" required>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="payor_type">Type of Payor</label>
        <select id="payor_type" name="payor_type" required>
          <option value="">Select Type</option>
          <option value="member">Member</option>
          <option value="non-member">Non-Member</option>
          <option value="sponsor">Sponsor</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="form-group">
        <label for="transaction_ref">Transaction / Reference Number</label>
        <input type="text" id="transaction_ref" name="transaction_ref" placeholder="Enter Transaction/Ref. No.">
      </div>
    </div>

    <!-- Payee Details -->
    <h4>Payee Details</h4>
    <div class="form-row">
      <div class="form-group">
        <label for="membership_no">Membership (Username)</label>
        <select id="membership_no" name="membership_no" required>
          <option value="">Select Member</option>
          <?php include "php/payments/select_usernames.php"; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="member_name">Full Name</label>
        <input type="text" id="member_name" name="member_name" placeholder="Full Name" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="payor_name">Payor Name</label>
      <input type="text" id="payor_name" name="payor_name" placeholder="Enter Payor Name">
        <div>
          <input type="checkbox" id="same_as_member" name="same_as_member">
          <label for="same_as_member">Same as Member</label>
        </div>
    </div>

    <!-- Payment Details -->
    <h4>Payment Details</h4>
    <div class="form-row">
      <div class="form-group">
        <label for="payment_location">Payment Location</label>
        <select id="payment_location" name="payment_location">
          <option value="">Select Location</option>
          <option value="pcp_office">PCP Office</option>
          <option value="bpi_bank">BPI Bank</option>
          <option value="bdo_bank">BDO Bank</option>
          <option value="gcash">GCash</option>
        </select>
      </div>
      <div class="form-group">
        <label for="payment_mode">Mode of Payment</label>
        <select id="payment_mode" name="payment_mode" required>
          <option value="">Select Mode</option>
          <option value="cash">Cash</option>
          <option value="bank_transfer">Bank Transfer</option>
          <option value="gcash">GCash</option>
          <option value="check">Check</option>
          <option value="credit_card">Credit Card</option>
        </select>
      </div>
    </div>

    <!-- Remarks -->
    <div class="form-group">
      <label for="remarks">Remarks</label>
      <textarea id="remarks" name="remarks" rows="3" placeholder="Enter remarks (optional)"></textarea>
    </div>

    <!-- Actions -->
    <div class="form-actions">
      <button type="reset" class="btn-reset">Clear</button>
      <button type="submit" class="btn-submit">Save Payment</button>
    </div>
  </form>
</div>

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
$(document).ready(function(){
  // Tabs switcher
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
  const searchInput = document.getElementById("filter-payment");
  const searchBtn = document.querySelector(".submit-search");
  const resetBtn = document.querySelector(".btn-reset");
  const tableRows = document.querySelectorAll(".payment-table tbody tr");

  function filterTable() {
    const filterValue = searchInput.value.toLowerCase().trim();

    tableRows.forEach(row => {
      const cells = row.querySelectorAll("td");
      let rowText = "";
      cells.forEach(cell => rowText += cell.textContent.toLowerCase() + " ");
      
      row.style.display = rowText.includes(filterValue) ? "" : "none";
    });
  }

  // Search button click
  searchBtn.addEventListener("click", filterTable);

  // Reset button click
  resetBtn.addEventListener("click", function () {
    searchInput.value = "";
    tableRows.forEach(row => (row.style.display = ""));
  });

  // Live search as user types
  searchInput.addEventListener("keyup", filterTable);
});
</script>
<script>
document.getElementById("membership_no").addEventListener("change", function() {
    let membershipNo = this.value;
    if (membershipNo) {
        fetch("php/payments/get_member_name.php?membership_no=" + membershipNo)
            .then(response => response.text())
            .then(data => {
                document.getElementById("member_name").value = data;
                // If "Same as Member" is checked, auto-fill payor_name too
                let payorCheckbox = document.getElementById("same_as_member");
                if (payorCheckbox.checked) {
                    document.getElementById("payor_name").value = data;
                }
            });
    } else {
        document.getElementById("member_name").value = "";
        document.getElementById("payor_name").value = "";
    }
});

// Sync payor name if checkbox is checked
document.getElementById("same_as_member").addEventListener("change", function() {
    if (this.checked) {
        document.getElementById("payor_name").value = 
            document.getElementById("member_name").value;
    } else {
        document.getElementById("payor_name").value = "";
    }
});
</script>

</body>
</html>
