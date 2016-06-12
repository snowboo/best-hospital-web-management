<?php

include 'ChromePhp.php';
include 'config.php';

session_start();

$tbl_name="Employee"; // Table name

// username and password sent from form
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = $conn->escape_string($myusername);
$mypassword = $conn->escape_string($mypassword);

//TODO: Hash passwords (lower priority)
$sql = "SELECT * FROM $tbl_name WHERE email='$myusername' AND eid='$mypassword'";
$result = $conn->query($sql);

$count = $result->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {
    // Register $myusername, $mypassword and redirect to file "login_success.php"
    $_SESSION['myusername'] = $myusername;
    $_SESSION['mypassword'] = $mypassword;
    // ChromePhp::log($_SESSION['myusername']);
    $doctorQuery = "SELECT * FROM Doctor WHERE eid='$mypassword'";
    $nurseQuery = "SELECT * FROM Nurse WHERE eid='$mypassword'";
    $receptionistQuery = "SELECT * FROM Receptionist WHERE eid='$mypassword'";

    $docResult = $conn->query($doctorQuery);
    $nurseResult = $conn->query($nurseQuery);
    $receptionistResult = $conn->query($receptionistQuery);
    if ($docResult->num_rows == 1) {
        echo "Doctor";
    } else if ($nurseResult->num_rows == 1) {
        echo "Nurse";
    } else if ($receptionistResult->num_rows == 1) {
        echo "Receptionist";
    } else {
        $employeeRow = $result->fetch_assoc();
        echo "Welcome " . $employeeRow['fname'] . " " . $employeeRow['lname'];
    }

    // header("location:login_success.php");
}
else {
    echo "Wrong Username or Password";
}
?>