<?php
session_start();
require_once __DIR__ . "/../../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Account
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $role = trim($_POST['role']);

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = " Passwords do not match!";
        header("Location: ../members.php");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prevent duplicate account
    $check = $conn->prepare("SELECT id FROM account WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $_SESSION['error'] = " Account already exists for this username!";
        header("Location: ../members.php");
        exit;
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO account (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $role);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Account insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }
    $member_no = $username;

    // Function to check duplicates
    function alreadyExists($conn, $table, $column, $member_no) {
        $sql = "SELECT 1 FROM $table WHERE $column = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $member_no);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    // Personal Info
    if (alreadyExists($conn, "personal_info", "pi_membership_no", $member_no)) {
        $_SESSION['error'] = " Personal Info already exists for this member!";
        header("Location: ../members.php");
        exit;
    }

    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $extname = $_POST['extension'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $nationality = $_POST['nationality'];
    $civilstatus = $_POST['civilstatus'];
    $partners_name = $_POST['partners_name'];

    $stmt = $conn->prepare("INSERT INTO personal_info 
        (pi_membership_no, lastname, middlename, extname, gender, birthdate, nationality, civilstatus, partners_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $member_no, $lastname, $middlename, $extname, $gender, $dob, $nationality, $civilstatus, $partners_name);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Personal Info insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }

    // Membership Info
    if (alreadyExists($conn, "membership_info", "m_membership_no", $member_no)) {
        $_SESSION['error'] = " Membership Info already exists for this member!";
        header("Location: ../members.php");
        exit;
    }

    $chapter = $_POST['chapter'];
    $category = $_POST['category'];
    $specialty = $_POST['specialty'];
    $sub_specialty = $_POST['sub_specialty'];
    $other_specialty = $_POST['other_specialty'];
    $classification = $_POST['classification'];
    $member_status = $_POST['member_status'];

    $stmt = $conn->prepare("INSERT INTO membership_info 
        (m_membership_no, member_chapter, member_category, specialty, sub_specialty, other_specialty, classification, member_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $member_no, $chapter, $category, $specialty, $sub_specialty, $other_specialty, $classification, $member_status);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Membership Info insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }

    // Credentials
    if (alreadyExists($conn, "credentials", "cre_membership_no", $member_no)) {
        $_SESSION['error'] = " Credentials already exist for this member!";
        header("Location: ../members.php");
        exit;
    }

    $prc = $_POST['prc'];
    $prc_expiry = $_POST['prc_expiry'];
    $pma = $_POST['pma'];
    $pma_expiry = $_POST['pma_expiry'];
    $phic = $_POST['phic'];
    $phic_expiry = $_POST['phic_expiry'];

    $stmt = $conn->prepare("INSERT INTO credentials 
        (cre_membership_no, prc, prc_expiry, pma, pma_expiry, phic, phic_expiry) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $member_no, $prc, $prc_expiry, $pma, $pma_expiry, $phic, $phic_expiry);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Credentials insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }

    // Contacts
    if (alreadyExists($conn, "contacts", "con_membership_no", $member_no)) {
        $_SESSION['error'] = " Contacts already exist for this member!";
        header("Location: ../members.php");
        exit;
    }

    $mobile = $_POST['mobile'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO contacts 
        (con_membership_no, mobile, phone, email) 
        VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $member_no, $mobile, $phone, $email);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Contacts insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }

    // Induction (multiple allowed)
    if (!empty($_POST['induction_category'])) {
        $induction_categories = $_POST['induction_category'];
        $dates = $_POST['date_inducted'];
        $remarks_arr = $_POST['remarks'];

        $stmt = $conn->prepare("INSERT INTO induction (i_membership_no, induc_category, induc_date, remarks) VALUES (?, ?, ?, ?)");
        foreach ($induction_categories as $i => $category) {
            $date = $dates[$i];
            $remark = $remarks_arr[$i];
            $stmt->bind_param("ssss", $member_no, $category, $date, $remark);
            if (!$stmt->execute()) {
                $_SESSION['error'] = " Induction insert error: " . $stmt->error;
                header("Location: ../members.php");
                exit;
            }
        }
    }

    // Address
    if (alreadyExists($conn, "home_address", "a_membership_no", $member_no)) {
        $_SESSION['error'] = " Address already exists for this member!";
        header("Location: ../members.php");
        exit;
    }

    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $zip = $_POST['zip'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    $stmt = $conn->prepare("INSERT INTO home_address 
        (a_membership_no, region, province, city, barangay, zip, address1, address2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $member_no, $region, $province, $city, $barangay, $zip, $address1, $address2);
    if (!$stmt->execute()) {
        $_SESSION['error'] = " Address insert error: " . $stmt->error;
        header("Location: ../members.php");
        exit;
    }

    // Done
    unset($_SESSION['member_no']);
    $_SESSION['success'] = " Member successfully added!";
    header("Location: ../members.php");
    exit;
}
?>
