<?php
include '../connection/conn.php'; // your DB connection
include '../admin/php/membership/getMembers.php';
session_start();
$message = "";
$type = "";
if (isset($_SESSION['error'])) {
    $message = $_SESSION['error'];
    $type = "error";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    $type = "success";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/members.css">
  <title>Members</title>
</head>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<body>
  <div class="content-container">
    <h5 class="title">Members</h5>
    <div class="member-search">
      <div class="total-members">
        <h3>Total Members: <?= count($members); ?></h3>
      </div>
      <hr>
      <div class="search-form">
        <form id="memberSearchForm">
          <div class="field">
            <label class="user">Name / Membership No.</label>
            <input type="text" id="searchName">
          </div>
          <div class="field">
            <label for="chapter">Chapter:</label>
            <select id="chapter" name="chapter">
              <option value="">--Select Chapter--</option>
              <?php include 'php/membership/getChapters.php'; ?>
            </select>
          </div>

          <button type="submit" class="submit-search">Submit</button>
          <button type="button" class="reset-form">Reset</button>
        </form>
      </div>

      <div class="search-display">
        <table class="members-table">
          <thead>
            <tr>
              <th>Membership No.</th>
              <th>Name</th>
              <th>Chapter</th>
              <th>Category</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="membersTableBody">
            <?php if (!empty($members)): ?>
                <?php foreach ($members as $m): ?>
                    <tr>
                        <td><?= $m['membership_no']; ?></td>
                        <td>
                            <?= $m['lastname'] . ', ' . $m['firstname'] . ' ' . $m['middlename'] . ' ' . $m['extname']; ?>
                        </td>
                        <td><?= $m['member_chapter']; ?></td>
                        <td><?= $m['member_category']; ?></td>
                        <td><?= $m['member_status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No members found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination" id="pagination"></div>

    </div>

    <h5 class="title">Create Member</h5>

    <div class="user-creation-content">
      <!-- Tabs Navigation -->
      <ul class="tabs">
        <li class="active">Account</li>
        <li>Personal Information</li>
        <li>Membership</li>
        <li>Contacts</li>
        <li>Induction</li>
        <li>Address</li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content">
        <form id="member-form" method="POST" action="php/membership/master_creation.php" enctype="multipart/form-data">
        <!-- Tab 1 -->
        <div class="tab-pane active" id="account-panel">
          <!-- Account Creation -->
          <div class="account-form">
            <div class="form-row">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
              </div>
              <div class="form-group">
                <label>Role</label>
                <select name="role" id="role" required>
                  <option value="member">Member</option>
                  <option value="admin">Admin</option>
                  <option value="superadmin">Super Admin</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
              </div>
            </div>
            
          </div>
        </div>
        
        <!-- Tab 2 -->
        <div class="tab-pane" id="personal-info-panel">
          <div class="personal-info-wrapper">
            <div class="file-upload">
              <!-- Preview -->
              <img src="default.png" alt="Profile Preview" class="file-preview" id="preview">
              
              <!-- Upload Button -->
              <label for="profile_pic" class="file-label">Upload Photo</label>
              <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
            </div>

            <!-- RIGHT: FORM -->
            <div class="account-form">
              <div class="form-row">
                <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
                </div>
              </div> 

              <div class="form-row">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                  <label for="middlename">Middle Name</label>
                  <input type="text" id="middlename" name="middlename">
                </div>
                <div class="form-group">
                  <label for="extension">Extension (Jr., Sr., III)</label>
                  <input type="text" id="extension" name="extension">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select id="gender" name="gender" required>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other / Prefer not to say</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="date" id="dob" name="dob" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="nationality">Nationality</label>
                  <input type="text" id="nationality" name="nationality" required>
                </div>
              </div>

              <hr class="divider">

              <div class="form-row">
                <div class="form-group">
                  <label for="civilstatus">Civil Status</label>
                  <select id="civilstatus" name="civilstatus" >
                    <option value="">Select status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                    <option value="divorced">Divorced</option>
                  </select>
                </div>
                <div class="form-row partner-row" style="display:none;">
                  <div class="form-group full-width">
                    <label for="partners_name">Partner’s Full Name</label>
                    <input type="text" id="partners_name" name="partners_name" placeholder="e.g., Juan Dela Cruz">
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Tab 4 -->
        <div class="tab-pane" id="membership-panel">
          <!-- MEMBERSHIP DETAILS -->
          <div class="account-form">
            <div class="form-row">
              <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
              </div>
            </div> 

            <div class="form-row">
              <!-- Chapter -->
              <div class="form-group">
                <label for="chapter">Chapter</label>
                <select id="chapter" name="chapter" required>
                  <option value="">-- Select Chapter --</option>
                  <option>Bicol</option>
                  <option>Bohol</option>
                  <option>Camanava</option>
                  <option>Capiz-Aklan</option>
                  <option>Caraga</option>
                  <option>Cebu</option>
                  <option>Central Luzon</option>
                  <option>Eastern Visayas</option>
                  <option>Ilocos-Abra</option>
                  <option>Lower-Northeastern Luzon</option>
                  <option>Manila</option>
                  <option>Marikina</option>
                  <option>Matapat</option>
                  <option>Negros Oriental</option>
                  <option>Northern Luzon</option>
                  <option>Northern Mindanao</option>
                  <option>Northwestern Luzon</option>
                  <option>Northwestern Mindanao</option>
                  <option>Pamunlas</option>
                  <option>Pasay</option>
                  <option>Pasjman</option>
                  <option>Quezon City</option>
                  <option>Rizal</option>
                  <option>Soccsksargen</option>
                  <option>Southern Luzon</option>
                  <option>Southern Mindanao</option>
                  <option>U-Northeastern Luzon</option>
                  <option>Western Mindanao</option>
                  <option>WV-Negros Occidental</option>
                  <option>WV-Panay</option>
                </select>
              </div>

              <!-- Category -->
              <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                  <option value="">-- Select Category --</option>
                  <option>Diplomate</option>
                  <option>Fellow Emeritus</option>
                  <option>Honorary Fellow</option>
                  <option>Life Fellow</option>
                  <option>Life Member</option>
                  <option>Member</option>
                  <option>Regular Fellow</option>
                  <option>Senior Fellow</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <!-- Specialty -->
              <div class="form-group">
                <label for="specialty">Specialty</label>
                <select id="specialty" name="specialty">
                  <option value="">-- Select Specialty --</option>
                  <option>General Internal Medicine</option>
                  <option>INTERNAL MEDICINE</option>
                  <option>Non-lM Dermatology</option>
                  <option>Non-lM Diabetology</option>
                  <option>Non-lM Geriatric Medicine</option>
                  <option>Non-lM Neurology</option>
                  <option>Non-lM Nuclear Medicine</option>
                </select>
              </div>

              <!-- Sub-Specialty -->
              <div class="form-group">
                <label for="sub_specialty">Sub-Specialty</label>
                <select id="sub_specialty" name="sub_specialty">
                  <option value="">-- Select Sub-Specialty --</option>
                  <option>ALLERGOLOGY-IMMUNOLOGY</option>
                  <option>CARDIOLOGY</option>
                  <option>DERMATOLOGY</option>
                  <option>ENDOCRINOLOGY, DIABETES & METABOLISM</option>
                  <option>GASTROENTEROLOGY</option>
                  <option>GERIATRIC MEDICINE</option>
                  <option>HEMATOLOGY</option>
                  <option>INFECTIOUS DISEASES</option>
                  <option>INTERNAL MEDICINE</option>
                  <option>MEDICAL ONCOLOGY</option>
                  <option>NEPHROLOGY</option>
                  <option>NEUROLOGY</option>
                  <option>NONE</option>
                  <option>NUCLEAR MEDICINE</option>
                  <option>ONCOLOGY</option>
                  <option>PULMONARY MEDICINE</option>
                  <option>RHEUMATOLOGY</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <!-- Other Sub-Specialty -->
              <div class="form-group">
                <label for="other_specialty">Other Sub-Specialty</label>
                <select id="other_specialty" name="other_specialty">
                  <option value="">-- Select Other Sub-Specialty --</option>
                  <option>ANESTHESIOLOGY</option>
                  <option>CARDIAC CATHETERIZATION</option>
                  <option>CARDIAC REHABILITATION</option>
                  <option>CARDIOLOGY-ELECTROPHYSIOLOGY</option>
                  <option>CARDIOLOGY-GASTROENTEROLOGY</option>
                  <option>CARDIOLOGY-NEPHROLOGY</option>
                  <option>CLINICAL EPIDEMIOLOGY</option>
                  <option>CLINICAL PHARMACOLOGY</option>
                  <option>CLINICAL TOXICOLOGY</option>
                  <option>CRITICAL CARE MEDICINE</option>
                  <option>DIABETOLOGY</option>
                  <option>DIGESTIVE ENDOSCOPY</option>
                  <option>ECHOCARDIOGRAPHY</option>
                  <option>ECHOCARDIOGRAPHY / VASCULAR MEDICINE</option>
                  <option>ECHOCARDIOGRAPHY AND VASCULAR MEDICINE</option>
                  <option>ELECTROPHYSIOLOGY</option>
                  <option>EMERGENCY MEDICINE</option>
                  <option>EMERGENCY MEDICINE-MEDICOLEGAL</option>
                  <option>ENDOCRINOLOGY-NUCLEAR MEDICINE</option>
                  <option>GASTROENTEROLOGY-DIABETOLOGY</option>
                  <option>GASTROENTEROLOGY-DIGESTIVE ENDOSCOPY</option>
                  <option>GASTROENTEROLOGY-HEPATOLOGY</option>
                  <option>GASTROENTEROLOGY-ONCOLOGY</option>
                  <option>GERIATIC CARDIOLOGY (CARDIAC REHABILITATION)</option>
                  <option>HEMATOLOGY-CLINICAL PATHOLOGY</option>
                  <option>HEMATOLOGY-MEDICAL ONCOLOGY</option>
                  <option>HEMATOLOGY/ONCOLOGY/IMMUNOLOGY</option>
                  <option>HEPATOLOGY</option>
                  <option>INFECTIOUS DISEASES-DIABETOLOGY</option>
                  <option>INFECTIOUS DISEASES-PULMONARY MEDICINE</option>
                  <option>INTERVENTIONAL CARDIOLOGY</option>
                  <option>MEDICAL ONCOLOGY-CLINICAL EPIDEMIOLOGY</option>
                  <option>MEDICO-LEGAL</option>
                  <option>NEPHROLOGY & DIABETOLOGY</option>
                  <option>NEPHROLOGY & HYPERTENSION</option>
                  <option>NEPHROLOGY & TRANSPLANTATION</option>
                  <option>NEPHROLOGY-ONCOLOGY</option>
                  <option>NEPHROLOGY-RHEUMATOLOGY</option>
                  <option>NEUROLOGY-CARDIOLOGY</option>
                  <option>NEUROLOGY-NEPHROLOGY</option>
                  <option>NO OTHER SUBSPECIALTY</option>
                  <option>OCCUPATIONAL & ENVIRONMENTAL MEDICINE</option>
                  <option>ONCOLOGY-HEMATOLOGY</option>
                  <option>Pain & Palliative Medicine</option>
                  <option>PERIPHERAL VASCULAR MEDICINE</option>
                  <option>PHARMACOLOGY-TOXICOLOGY</option>
                  <option>PULMONOLOGY-CRITICAL CARE MEDICINE</option>
                  <option>PULMONOLOGY-DIABETOLOGY</option>
                  <option>PULMONOLOGY-ONCOLOGY</option>
                  <option>RADIOLOGY</option>
                  <option>RESEARCH-EPIDEMIOLOGY</option>
                  <option>RHEUMATOLOGY-DERMATOLOGY</option>
                  <option>RHEUMATOLOGY/CLINICAL IMMUNOLOGY</option>
                  <option>VASCULAR MEDICINE</option>
                </select>
              </div>

              <!-- Classification -->
              <div class="form-group">
                <label for="classification">Classification</label>
                <select id="classification" name="classification">
                  <option value="">-- Select Classification --</option>
                  <option>Generalist</option>
                  <option>Specialist</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <!-- Membership Status -->
              <div class="form-group">
                <label for="member_status">Membership Status</label>
                <select id="member_status" name="member_status" required>
                  <option value="">-- Select Status --</option>
                  <option value="Active">Active</option>
                  <option value="Deceased">Deceased</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Terminated">Terminated</option>
                  <option value="Conditional">Conditional</option>
                  <option value="Suspended">Suspended</option>
                  <option value="Invalid Account">Invalid Account</option>
                </select>
              </div>
            </div>
          </div>


          <hr class="divider">

          <!-- CREDENTIALS -->
          <div class="account-form">
              <div class="form-row">
                <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
                </div>
              </div> 
            <div class="form-row">
              <div class="form-group">
                <label for="prc">PRC Number</label>
                <input type="text" id="prc" name="prc">
              </div>
              <div class="form-group">
                <label for="prc_expiry">PRC Expiry</label>
                <input type="date" id="prc_expiry" name="prc_expiry">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="pma">PMA Number</label>
                <input type="text" id="pma" name="pma">
              </div>
              <div class="form-group">
                <label for="pma_expiry">PMA Expiry</label>
                <input type="date" id="pma_expiry" name="pma_expiry">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="phic">PHIC Number</label>
                <input type="text" id="phic" name="phic">
              </div>
              <div class="form-group">
                <label for="phic_expiry">PHIC Expiry</label>
                <input type="date" id="phic_expiry" name="phic_expiry">
              </div>
            </div>

          </div>
        </div>
        
        <!-- Tab 5 -->
        <div class="tab-pane" id="contacts-panel">
          <!-- CONTACTS -->
          <div class="account-form">
            <div class="form-row">
              <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
              </div>
            </div> 

            <div class="form-row">
              <!-- Mobile -->
              <div class="form-group">
                <label for="mobile">
                  Mobile Number
                  <span class="info-icon" title="Enter 10-digit mobile (e.g. +63)">
                    <img src="../img/info.png" alt="info">
                  </span>
                </label>
                <input type="tel" id="mobile" name="mobile" value="+63" pattern="^\+63[0-9]{10}$" maxlength="13" required oninput="formatMobile(this)">
              </div>
              <!-- Phone -->
              <div class="form-group">
                <label for="phone">
                  Phone Number
                  <span class="info-icon" title="Enter landline number">
                    <img src="../img/info.png" alt="info">
                  </span>
                </label>
                <input type="tel" id="phone" name="phone" pattern="^[0-9]{7,9}$" maxlength="9"oninput="this.value=this.value.replace(/[^0-9]/g,'');">
              </div>
            </div>

            <div class="form-row">
              <!-- Email -->
              <div class="form-group">
                <label for="email">
                  Email Address
                  <span class="info-icon" title="Enter valid email (e.g. user@example.com)">
                    <img src="../img/info.png" alt="info">
                  </span>
                </label>
                <input type="email" id="email" name="email" required>
              </div>
            </div>

          </div>
        </div>

        <!-- Tab 6 -->
        <!-- Induction Tab -->
        <div class="tab-pane" id="induction-panel">
          <div class="account-form" id="induction-form">
            <div class="form-row">
              <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="induction-category">Category</label>
                <select id="induction-category" name="induction-category" >
                  <option value="">-- Select Category --</option>
                  <option value="Diplomate">Diplomate</option>
                  <option value="Fellow Emeritus">Fellow Emeritus</option>
                  <option value="Honorary Fellow">Honorary Fellow</option>
                  <option value="Life Fellow">Life Fellow</option>
                  <option value="Life Member">Life Member</option>
                  <option value="Member">Member</option>
                  <option value="Regular Fellow">Regular Fellow</option>
                  <option value="Senior Fellow">Senior Fellow</option>
                </select>
              </div>
              <div class="form-group">
                <label for="induction-date">Date Inducted</label>
                <input type="date" id="induction-date" name="induction-date">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="induction-remarks">Remarks</label>
                <textarea id="induction-remarks" name="induction-remarks"></textarea>
              </div>
            </div>

            <div class="form-actions">
              <button type="reset" class="btn-reset">Clear</button>
              <button type="button" class="btn-add-induction">Add Record</button>
            </div>

            <hr class="divider">

            <h3>Induction Records</h3>
            <table class="induction-table">
              <thead>
                <tr>
                  <th>Membership Number</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Remarks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="induction-tbody">
                <!-- Rows added dynamically here -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- Tab 7 -->
        <div class="tab-pane" id="address-panel">
          <!-- ADDRESS -->
          <div class="account-form">
              <div class="form-row">
                <div class="form-group">
                <input type="text" id="member-no" name="member-no" readonly>
                </div>
              </div> 
              <div class="form-row">
              <div class="form-group">
                <label for="region">Region:</label>
                <select id="region" name="region" >
                  <option value="">Select Region</option>
                </select>
              </div>
              <div class="form-group">
                <label for="province">Province:</label>
                <select id="province" name="province" >
                  <option value="">Select Province</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="city">City/Municipality:</label>
                <select id="city" name="city" >
                  <option value="">Select City/Municipality</option>
                </select>
              </div>
              <div class="form-group">
                <label for="barangay">Barangay:</label>
                <select id="barangay" name="barangay" >
                  <option value="">Select Barangay</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="zip">Zip Code:</label>
                <input type="text" id="zip" name="zip" placeholder="Enter Zip Code" >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group full-width">
                <label for="address1">Address 1:</label>
                <input type="text" id="address1" name="address1" >
              </div>
            </div>

            <div class="form-row">
              <div class="form-group full-width">
                <label for="address2">Address 2:</label>
                <input type="text" id="address2" name="address2">
              </div>
            </div>

            <div class="form-actions">
              <button type="reset" class="btn-reset">Clear</button>
              <button type="submit" class="btn-submit">Submit</button>
            </div>
          </div>
        </div>
        </form> 
      </div>
    </div>
  </div>

<?php if (!empty($message)): ?>
<div id="popupModal" class="popup-modal">
  <div class="popup-content <?= $type ?>">
    <span class="popup-close" onclick="closePopup()">&times;</span>
    <p><?= $message ?></p>
  </div>
</div>
<?php endif; ?>
</body>

<script>
document.querySelectorAll(".tabs li").forEach((tab, index) => {
    tab.addEventListener("click", (e) => {
        const activeTab = document.querySelector(".tab-pane.active");
        const inputs = activeTab.querySelectorAll("input, select, textarea");

        // Check validity of required fields in current tab
        let valid = true;
        for (let input of inputs) {
            if (!input.checkValidity()) {
                input.reportValidity(); // show browser's validation popup
                valid = false;
                break;
            }
        }

        // Stop navigation if invalid
        if (!valid && index > [...document.querySelectorAll(".tab-pane")].indexOf(activeTab)) {
            e.preventDefault();
            return;
        }

        // Switch tab normally if valid
        document.querySelectorAll(".tabs li").forEach(el => el.classList.remove("active"));
        document.querySelectorAll(".tab-pane").forEach(el => el.classList.remove("active"));

        tab.classList.add("active");
        document.querySelectorAll(".tab-pane")[index].classList.add("active");
    });
});
</script>


<!-- dropdown civil -->
<script>
(function () {
    const civil = document.getElementById('civilstatus');
    const partnerRow = document.querySelector('.partner-row');
    const partnerInput = document.getElementById('partners_name');
    const form = document.querySelector('.account-form');

    function togglePartner() {
        const show = civil.value === 'married';
        partnerRow.style.display = show ? 'flex' : 'none';
        partnerInput.required = show;
        if (!show) partnerInput.value = '';
    }

    civil.addEventListener('change', togglePartner);
    form.addEventListener('reset', () => setTimeout(togglePartner, 0));
    togglePartner(); // set initial state on load
})();
</script>

<!-- for automated address -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const regionSelect = document.getElementById("region");
    const provinceSelect = document.getElementById("province");
    const citySelect = document.getElementById("city");
    const barangaySelect = document.getElementById("barangay");

    fetch("script/address.json")
    .then(response => response.json())
    .then(data => {
        Object.keys(data).forEach(region => {
            let option = document.createElement("option");
            option.value = region;
            option.textContent = region;
            regionSelect.appendChild(option);
        });

        regionSelect.addEventListener("change", function () {
            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            if (this.value) {
                Object.keys(data[this.value].province_list).forEach(province => {
                    let option = document.createElement("option");
                    option.value = province;
                    option.textContent = province;
                    provinceSelect.appendChild(option);
                });
            }
        });

        provinceSelect.addEventListener("change", function () {
            citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            if (this.value) {
                Object.keys(
                    data[regionSelect.value].province_list[this.value].municipality_list
                ).forEach(city => {
                    let option = document.createElement("option");
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        });

        citySelect.addEventListener("change", function () {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            if (this.value) {
                data[regionSelect.value].province_list[provinceSelect.value]
                    .municipality_list[this.value].barangay_list.forEach(barangay => {
                        let option = document.createElement("option");
                        option.value = barangay;
                        option.textContent = barangay;
                        barangaySelect.appendChild(option);
                    });
            }
        });
    })
    .catch(err => console.error("Error loading address.json:", err));
});
</script>

<!-- for hidden membership number with the same content -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const usernameInput = document.getElementById("username");
    const membershipInputs = document.querySelectorAll("input[name='member-no']");

    usernameInput.addEventListener("input", function () {
        membershipInputs.forEach(input => {
            input.value = usernameInput.value;
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const inductionForm = document.getElementById("induction-form");
  const tbody = document.getElementById("induction-tbody");

  inductionForm.querySelector(".btn-add-induction").addEventListener("click", function() {
    const memberNo = inductionForm.querySelector("input[name='member-no']").value.trim();
    const category = inductionForm.querySelector("select[name='induction-category']").value.trim();
    const dateInducted = inductionForm.querySelector("input[name='induction-date']").value.trim();
    const remarks = inductionForm.querySelector("textarea[name='induction-remarks']").value.trim();

    if (!category || !dateInducted) {
      alert("Category and Date are required!");
      return;
    }

    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${memberNo}</td>
      <td>${category}<input type="hidden" name="induction_category[]" value="${category}"></td>
      <td>${dateInducted}<input type="hidden" name="date_inducted[]" value="${dateInducted}"></td>
      <td>${remarks}<input type="hidden" name="remarks[]" value="${remarks}"></td>
      <td><button type="button" class="btn-delete">Delete</button></td>
    `;
    tbody.appendChild(tr);

    // Reset fields
    inductionForm.querySelector("select[name='induction-category']").value = "";
    inductionForm.querySelector("input[name='induction-date']").value = "";
    inductionForm.querySelector("textarea[name='induction-remarks']").value = "";

    // Delete row
    tr.querySelector(".btn-delete").addEventListener("click", () => tr.remove());
  });
});
</script>

<script>
function closePopup() {
  document.getElementById("popupModal").style.display = "none";
}
</script>
<script>
function formatMobile(input) {
  // Always keep +63 at the start
  if (!input.value.startsWith("+63")) {
    input.value = "+63";
  }
  // Only allow numbers after +63
  input.value = "+63" + input.value.substring(3).replace(/[^0-9]/g, "");
  // Limit to 10 digits after +63
  if (input.value.length > 13) {
    input.value = input.value.substring(0, 13);
  }
}
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const tableBody = document.getElementById('membersTableBody');
  const form = document.getElementById('memberSearchForm');
  const resetBtn = document.querySelector('.reset-form');
  const pagination = document.getElementById('pagination');

  const members = <?php echo json_encode($members ?? []); ?>;
  const rowsPerPage = 2;
  let currentPage = 1;
  let currentData = members;

  function renderTable(data, page = 1) {
    tableBody.innerHTML = '';
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedData = data.slice(start, end);

    if (paginatedData.length === 0) {
      tableBody.innerHTML = '<tr><td colspan="5">No members found.</td></tr>';
    } else {
      paginatedData.forEach(m => {
        const row = `
          <tr>
            <td>${m.membership_no}</td>
            <td>${m.lastname}, ${m.firstname} ${m.middlename || ''} ${m.extname || ''}</td>
            <td>${m.member_chapter}</td>
            <td>${m.member_category}</td>
            <td>${m.member_status}</td>
          </tr>`;
        tableBody.innerHTML += row;
      });
    }
    renderPagination(data, page);
  }

  function renderPagination(data, page) {
    pagination.innerHTML = '';
    const totalPages = Math.ceil(data.length / rowsPerPage);
    if (totalPages <= 1) return;

    // Prev
    const prev = document.createElement('a');
    prev.href = "#";
    prev.textContent = '« Prev';
    prev.classList.add('prev');
    prev.addEventListener('click', e => {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        renderTable(currentData, currentPage);
      }
    });
    pagination.appendChild(prev);

    // Numbers
    for (let i = 1; i <= totalPages; i++) {
      const link = document.createElement('a');
      link.href = "#";
      link.textContent = i;
      if (i === page) link.classList.add('active');
      link.addEventListener('click', e => {
        e.preventDefault();
        currentPage = i;
        renderTable(currentData, currentPage);
      });
      pagination.appendChild(link);
    }

    // Next
    const next = document.createElement('a');
    next.href = "#";
    next.textContent = 'Next »';
    next.classList.add('next');
    next.addEventListener('click', e => {
      e.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        renderTable(currentData, currentPage);
      }
    });
    pagination.appendChild(next);
  }

  // Initial render
  renderTable(members);

  form.addEventListener('submit', e => {
    e.preventDefault();
    const searchName = document.getElementById('searchName').value.toLowerCase();
    const chapter = document.getElementById('chapter').value.toLowerCase();

    currentData = members.filter(m => {
      const fullName = (m.lastname + ' ' + m.firstname + ' ' + (m.middlename || '') + ' ' + (m.extname || '')).toLowerCase();
      const membershipNo = m.membership_no.toLowerCase();
      const chapterMatch = chapter === '' || m.member_chapter.toLowerCase() === chapter;

      return (
        (searchName === '' || fullName.includes(searchName) || membershipNo.includes(searchName)) &&
        chapterMatch
      );
    });

    currentPage = 1;
    renderTable(currentData, currentPage);
  });

  resetBtn.addEventListener('click', () => {
    document.getElementById('searchName').value = '';
    document.getElementById('chapter').value = '';
    currentData = members;
    currentPage = 1;
    renderTable(currentData, currentPage);
  });
});
</script>
<script>
document.getElementById('profile_pic').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        alert("Please select a valid image file.");
        event.target.value = ""; // reset invalid input
    }
});
</script>

<?php include '../footer.php'; ?>
</html>
