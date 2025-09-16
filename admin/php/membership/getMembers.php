<?php
include '../connection/conn.php';

// SQL query with JOIN ensuring unique usernames
$sql = "
    SELECT 
        a.username AS membership_no,
        pi.lastname,
        pi.firstname,
        pi.middlename,
        pi.extname,
        m.member_chapter,
        m.member_category,
        m.member_status
    FROM account a
    LEFT JOIN personal_info pi 
        ON a.username = pi.pi_membership_no
    LEFT JOIN membership_info m 
        ON a.username = m.m_membership_no
    GROUP BY a.username
";

$result = $conn->query($sql);

$members = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
}
