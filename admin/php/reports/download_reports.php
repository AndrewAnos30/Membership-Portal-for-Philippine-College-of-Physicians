<?php
include '../../../connection/conn.php';

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

// Base query
$sql = "
  SELECT 
    a.username AS membership_no,
    pi.firstname, pi.lastname, pi.middlename, pi.extname,
    mi.member_chapter, mi.member_category, mi.specialty, mi.sub_specialty, mi.other_specialty, mi.classification, mi.member_status,
    MAX(i.induc_date) AS induc_date
  FROM membership_info mi
  JOIN account a ON mi.m_membership_no = a.username
  LEFT JOIN personal_info pi ON pi.pi_membership_no = a.username
  LEFT JOIN induction i ON i.i_membership_no = a.username
  WHERE 1=1
";

// Apply filters dynamically
if ($chapter !== '')        $sql .= " AND mi.member_chapter = '".$conn->real_escape_string($chapter)."' ";
if ($status !== '')         $sql .= " AND mi.member_status = '".$conn->real_escape_string($status)."' "; // FIXED
if ($specialty !== '')      $sql .= " AND mi.specialty = '".$conn->real_escape_string($specialty)."' ";
if ($subspecialty !== '')   $sql .= " AND mi.sub_specialty = '".$conn->real_escape_string($subspecialty)."' ";
if ($other_sub !== '')      $sql .= " AND mi.other_specialty = '".$conn->real_escape_string($other_sub)."' ";
if ($classification !== '') $sql .= " AND mi.classification = '".$conn->real_escape_string($classification)."' ";
if ($category !== '')       $sql .= " AND mi.member_category = '".$conn->real_escape_string($category)."' ";
if ($month !== '')          $sql .= " AND MONTH(i.induc_date) = ".intval($month)." ";
if ($year  !== '')          $sql .= " AND YEAR(i.induc_date) = ".intval($year)." ";

$sql .= " GROUP BY a.username ";

$result = $conn->query($sql);

// CSV Headers
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
while ($row = $result->fetch_assoc()) {
    $fullname = trim($row['firstname']." ".$row['middlename']." ".$row['lastname']." ".$row['extname']);
    fputcsv($output, [
        $row['membership_no'], $fullname, $row['member_chapter'],
        $row['member_category'], $row['specialty'], $row['sub_specialty'],
        $row['other_specialty'], $row['classification'], $row['member_status'],
        $row['induc_date']
    ]);
}

fclose($output);
exit;
?>
