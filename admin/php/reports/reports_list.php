<?php
include '../connection/conn.php';

// Collect filters
$chapter        = $_GET['chapter'] ?? '';
$status         = $_GET['status'] ?? '';
$specialty      = $_GET['specialty'] ?? '';
$subspecialty   = $_GET['subspecialty'] ?? '';
$other_sub      = $_GET['other_subspecialty'] ?? '';
$classification = $_GET['classification'] ?? '';
$month          = $_GET['month'] ?? '';
$year           = $_GET['year'] ?? '';
$category       = $_GET['category'] ?? '';
$download       = $_GET['download'] ?? '';

// =============================
// Pagination setup
// =============================
$limit = 5; // rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// =============================
// Base query
// =============================
$sqlBase = "
  FROM membership_info mi
  JOIN account a ON mi.m_membership_no = a.username
  LEFT JOIN personal_info pi ON pi.pi_membership_no = a.username
  LEFT JOIN induction i ON i.i_membership_no = a.username
  WHERE 1=1
";

// Filters
if ($chapter !== '')        $sqlBase .= " AND mi.member_chapter = '".$conn->real_escape_string($chapter)."' ";
if ($status !== '')         $sqlBase .= " AND mi.member_status = '".strtolower($conn->real_escape_string($status))."' ";
if ($specialty !== '')      $sqlBase .= " AND mi.specialty = '".$conn->real_escape_string($specialty)."' ";
if ($subspecialty !== '')   $sqlBase .= " AND mi.sub_specialty = '".$conn->real_escape_string($subspecialty)."' ";
if ($other_sub !== '')      $sqlBase .= " AND mi.other_specialty = '".$conn->real_escape_string($other_sub)."' ";
if ($classification !== '') $sqlBase .= " AND mi.classification = '".$conn->real_escape_string($classification)."' ";
if ($category !== '')       $sqlBase .= " AND mi.member_category = '".$conn->real_escape_string($category)."' ";
if ($month !== '')          $sqlBase .= " AND MONTH(i.induc_date) = ".intval($month)." ";
if ($year  !== '')          $sqlBase .= " AND YEAR(i.induc_date) = ".intval($year)." ";

// =============================
// Get total count (for pagination)
// =============================
$countSql = "SELECT COUNT(DISTINCT a.username) as total ".$sqlBase;
$countResult = $conn->query($countSql);
$totalRecords = $countResult ? $countResult->fetch_assoc()['total'] : 0;
$totalPages = ceil($totalRecords / $limit);

// =============================
// Fetch paginated data
// =============================
$dataSql = "
  SELECT 
    a.username AS membership_no,
    pi.firstname, pi.lastname, pi.middlename, pi.extname,
    mi.member_chapter, mi.member_category, mi.specialty, mi.sub_specialty, mi.other_specialty, mi.classification, mi.member_status,
    MAX(i.induc_date) AS induc_date
  ".$sqlBase."
  GROUP BY a.username
  LIMIT $limit OFFSET $offset
";

$result = $conn->query($dataSql);

// =============================
// If download requested → CSV
// =============================
if ($download == "1") {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=pcp_reports.csv');

    $output = fopen('php://output', 'w');

    // Header row
    fputcsv($output, [
        'Membership No', 'Name', 'Chapter', 'Category',
        'Specialty', 'Sub-Specialty', 'Other Specialty',
        'Classification', 'Status', 'Induction Date'
    ]);

    // Data rows
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fullname = trim($row['firstname']." ".$row['middlename']." ".$row['lastname']." ".$row['extname']);
            fputcsv($output, [
                $row['membership_no'], $fullname, $row['member_chapter'],
                $row['member_category'], $row['specialty'], $row['sub_specialty'],
                $row['other_specialty'], $row['classification'], $row['member_status'],
                $row['induc_date']
            ]);
        }
    }

    fclose($output);
    exit; // stop here (don’t print HTML)
}

// =============================
// Otherwise → show table
// =============================
echo "<div class='table-wrapper'>";
echo "<table class='payment-table'>";
echo "<thead>
        <tr>
          <th>Membership No</th>
          <th>Name</th>
          <th>Chapter</th>
          <th>Category</th>
          <th>Specialty</th>
          <th>Sub-Specialty</th>
          <th>Other Specialty</th>
          <th>Classification</th>
          <th>Status</th>
          <th>Induction Date</th>
        </tr>
      </thead>
      <tbody>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fullname = trim($row['firstname']." ".$row['middlename']." ".$row['lastname']." ".$row['extname']);
        echo "<tr>
                <td>".$row['membership_no']."</td>
                <td>".$fullname."</td>
                <td>".$row['member_chapter']."</td>
                <td>".$row['member_category']."</td>
                <td>".$row['specialty']."</td>
                <td>".$row['sub_specialty']."</td>
                <td>".$row['other_specialty']."</td>
                <td>".$row['classification']."</td>
                <td>".$row['member_status']."</td>
                <td>".$row['induc_date']."</td>
              </tr>";
    }
} else {
    echo "<tr class='no-data'><td colspan='10'>No data found for selected filters</td></tr>";
}

echo "</tbody></table></div>";
// =============================
// Pagination controls (always visible)
// =============================
echo "<div class='pagination'>";
echo "<div class='pages'>";

$queryString = $_GET;
if (isset($queryString['page'])) unset($queryString['page']);

// Prev button
if ($page > 1) {
    $queryString['page'] = $page - 1;
    echo "<a href='?".http_build_query($queryString)."'>&laquo; Prev</a>";
} else {
    echo "<a class='disabled'>&laquo; Prev</a>";
}

// Page numbers
for ($i = 1; $i <= max(1, $totalPages); $i++) {
    $queryString['page'] = $i;
    $active = $i == $page ? "active" : "";
    echo "<a href='?".http_build_query($queryString)."' class='$active'>$i</a>";
}

// Next button
if ($page < $totalPages) {
    $queryString['page'] = $page + 1;
    echo "<a href='?".http_build_query($queryString)."'>Next &raquo;</a>";
} else {
    echo "<a class='disabled'>Next &raquo;</a>";
}

echo "</div>";
echo "<div class='rows'>Page $page of ".max(1, $totalPages)."</div>";
echo "</div>";

?>
