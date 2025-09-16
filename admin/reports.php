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
<title>Reports</title>
<link rel="stylesheet" href="style/reports.css">
</head>
<body>

<div class="content-container">
  <div class="card">
    <h2>Reports</h2>

    <!-- Filter Form -->
    <div class="filter-form">
      <form action="reports.php" method="GET">

        <!-- First Row: Filters -->
        <div class="fields">

          <!-- Chapters -->
          <div class="field">
            <select name="chapter">
              <option value="">All Chapters</option>
              <?php
                $chapters = $conn->query("SELECT DISTINCT chapter FROM chapters ORDER BY chapter ASC");
                while ($row = $chapters->fetch_assoc()) {
                  $selected = ($_GET['chapter'] ?? '') === $row['chapter'] ? 'selected' : '';
                  echo "<option value='".$row['chapter']."' $selected>".$row['chapter']."</option>";
                }
              ?>
            </select>
          </div>

          <!-- Status -->
          <div class="field">
            <select name="status">
              <option value="">All Status</option>
              <?php
                $statuses = ["Deceased","Active","Inactive","Terminated","Conditional","Suspended","Invalid Account"];
                foreach ($statuses as $s) {
                  $selected = ($_GET['status'] ?? '') === $s ? 'selected' : '';
                  echo "<option value='$s' $selected>$s</option>";
                }
              ?>
            </select>
          </div>


          <!-- Specialty -->
          <div class="field">
            <select name="specialty">
              <option value="">Select Specialty</option>
              <?php
                $specialties = [
                  "Non-IM","General Internal Medicine","INTERNAL MEDICINE",
                  "Non-lM Dermatology","Non-lM Diabetology","Non-lM Geriatric Medicine",
                  "Non-lM Neurology","Non-lM Nuclear Medicine"
                ];
                foreach ($specialties as $s) {
                  $selected = ($_GET['specialty'] ?? '') === $s ? 'selected' : '';
                  echo "<option value='$s' $selected>$s</option>";
                }
              ?>
            </select>
          </div>

          <!-- Subspecialty -->
          <div class="field">
            <select name="subspecialty">
              <option value="">Select Subspecialty</option>
              <?php
                $subspecialties = [
                  "ALLERGOLOGY-IMMUNOLOGY","CARDIOLOGY","DERMATOLOGY","ENDOCRINOLOGY, DIABETES & METABOLISM",
                  "GASTROENTEROLOGY","GERIATRIC MEDICINE","HEMATOLOGY","INFECTIOUS DISEASES","INTERNAL MEDICINE",
                  "MEDICAL ONCOLOGY","NEPHROLOGY","NEUROLOGY","NUCLEAR MEDICINE","PULMONARY MEDICINE","RHEUMATOLOGY"
                ];
                foreach ($subspecialties as $s) {
                  $selected = ($_GET['subspecialty'] ?? '') === $s ? 'selected' : '';
                  echo "<option value='$s' $selected>$s</option>";
                }
              ?>
            </select>
          </div>

          <!-- Other Subspecialty -->
          <div class="field">
            <select name="other_subspecialty">
              <option value="">-- Select Other Sub-Specialty --</option>
              <?php
                $others = [
                  "ANESTHESIOLOGY","CARDIAC CATHETERIZATION","CARDIAC REHABILITATION","CARDIOLOGY-ELECTROPHYSIOLOGY",
                  "CARDIOLOGY-GASTROENTEROLOGY","CARDIOLOGY-NEPHROLOGY","CLINICAL EPIDEMIOLOGY","CLINICAL PHARMACOLOGY",
                  "CLINICAL TOXICOLOGY","CRITICAL CARE MEDICINE","DIABETOLOGY","DIGESTIVE ENDOSCOPY","ECHOCARDIOGRAPHY",
                  "ECHOCARDIOGRAPHY / VASCULAR MEDICINE","ECHOCARDIOGRAPHY AND VASCULAR MEDICINE","ELECTROPHYSIOLOGY",
                  "EMERGENCY MEDICINE","EMERGENCY MEDICINE-MEDICOLEGAL","ENDOCRINOLOGY-NUCLEAR MEDICINE",
                  "GASTROENTEROLOGY-DIABETOLOGY","GASTROENTEROLOGY-DIGESTIVE ENDOSCOPY","GASTROENTEROLOGY-HEPATOLOGY",
                  "GASTROENTEROLOGY-ONCOLOGY","GERIATIC CARDIOLOGY (CARDIAC REHABILITATION)","HEMATOLOGY-CLINICAL PATHOLOGY",
                  "HEMATOLOGY-MEDICAL ONCOLOGY","HEMATOLOGY/ONCOLOGY/IMMUNOLOGY","HEPATOLOGY","INFECTIOUS DISEASES-DIABETOLOGY",
                  "INFECTIOUS DISEASES-PULMONARY MEDICINE","INTERVENTIONAL CARDIOLOGY","MEDICAL ONCOLOGY-CLINICAL EPIDEMIOLOGY",
                  "MEDICO-LEGAL","NEPHROLOGY & DIABETOLOGY","NEPHROLOGY & HYPERTENSION","NEPHROLOGY & TRANSPLANTATION",
                  "NEPHROLOGY-ONCOLOGY","NEPHROLOGY-RHEUMATOLOGY","NEUROLOGY-CARDIOLOGY","NEUROLOGY-NEPHROLOGY",
                  "NO OTHER SUBSPECIALTY","OCCUPATIONAL & ENVIRONMENTAL MEDICINE","ONCOLOGY-HEMATOLOGY",
                  "Pain & Palliative Medicine","PERIPHERAL VASCULAR MEDICINE","PHARMACOLOGY-TOXICOLOGY",
                  "PULMONOLOGY-CRITICAL CARE MEDICINE","PULMONOLOGY-DIABETOLOGY","PULMONOLOGY-ONCOLOGY","RADIOLOGY",
                  "RESEARCH-EPIDEMIOLOGY","RHEUMATOLOGY-DERMATOLOGY","RHEUMATOLOGY/CLINICAL IMMUNOLOGY","VASCULAR MEDICINE"
                ];
                foreach ($others as $s) {
                  $selected = ($_GET['other_subspecialty'] ?? '') === $s ? 'selected' : '';
                  echo "<option value='$s' $selected>$s</option>";
                }
              ?>
            </select>
          </div>

          <!-- Classification -->
          <div class="field">
            <select name="classification">
              <option value="">All Classifications</option>
              <?php
                $classifications = ["Generalist","Specialist"];
                foreach ($classifications as $c) {
                  $selected = ($_GET['classification'] ?? '') === $c ? 'selected' : '';
                  echo "<option value='$c' $selected>$c</option>";
                }
              ?>
            </select>
          </div>

          <!-- Month -->
          <div class="field">
            <select name="month">
              <option value="">All Months</option>
              <?php 
                for ($m = 1; $m <= 12; $m++) {
                  $monthName = date("F", mktime(0, 0, 0, $m, 1));
                  $selected = ($_GET['month'] ?? '') == $m ? 'selected' : '';
                  echo "<option value='$m' $selected>$monthName</option>";
                }
              ?>
            </select>
          </div>

          <!-- Year -->
          <div class="field">
            <select name="year">
              <option value="">All Years</option>
              <?php 
                for ($y = 1980; $y <= date("Y"); $y++) {
                  $selected = ($_GET['year'] ?? '') == $y ? 'selected' : '';
                  echo "<option value='$y' $selected>$y</option>";
                }
              ?>
            </select>
          </div>

          <!-- Categories -->
          <div class="field">
            <select name="category">
              <option value="">All Categories</option>
              <?php
                $categories = ["Diplomate","Fellow Emeritus","Honorary Fellow","Life Fellow","Life Member","Member","Regular Fellow","Senior Fellow"];
                foreach ($categories as $c) {
                  $selected = ($_GET['category'] ?? '') === $c ? 'selected' : '';
                  echo "<option value='$c' $selected>$c</option>";
                }
              ?>
            </select>
          </div>
        </div>

        <!-- Second Row: Actions -->
        <div class="actions">
          <button type="submit" id="apply-filters">Apply Filters</button>
          <button type="reset" id="reset-filters">Reset</button>
          <button type="submit" formaction="php/reports/download_reports.php" formmethod="GET" id="download-report">Download</button>
        </div>

      </form>
    </div>

    <!-- Reports Table Placeholder -->
    <div class="reports-table">
      <?php include "php/reports/reports_list.php"; ?>
    </div>

  </div>
</div>

</body>
</html>
