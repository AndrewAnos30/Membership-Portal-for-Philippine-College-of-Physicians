<?php
include "../../../connection/conn.php"; // go up 3 levels to connection folder

if (isset($_GET['membership_no'])) {
    $membership_no = $_GET['membership_no'];

    $sql = "SELECT firstname, middlename, lastname, extname 
            FROM personal_info 
            WHERE pi_membership_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $membership_no);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $fullname = $row['firstname'];

        if (!empty($row['middlename'])) {
            $fullname .= " " . $row['middlename'];
        }

        $fullname .= " " . $row['lastname'];

        if (!empty($row['extname'])) {
            $fullname .= " " . $row['extname'];
        }
        
        echo $fullname;
    } else {
        echo "";
    }
}
?>
