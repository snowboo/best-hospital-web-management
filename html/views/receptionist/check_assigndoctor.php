<?php

// include '../../resources/ChromePhp.php';
include '../../resources/config.php';

session_start();
$tbl_name="Patient_Attendedby"; // Table name


//set eid to global variable
$eid = $_POST['eid'];
$_SESSION['eid']= $eid;

//regain the patient information from the checkpatient.php
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$age = $_SESSION['age'];
$address = $_SESSION['address'];
$sex = $_SESSION['sex'];
$carecardnum = $_SESSION['carecardnum'];


//SQL query to update the table by assigning a doctor eid to the particular patient
$sql = "
UPDATE $tbl_name
SET fname = '$fname',
lname = '$lname',
age = '$age',
address = '$address',
sex = '$sex',
carecardnum = '$carecardnum',
eid = '$eid'
WHERE fname = '$fname' AND
lname = '$lname' AND
age = '$age' AND
address = '$address' AND
sex = '$sex' AND
carecardnum = '$carecardnum'
";

$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
	$doctor_assigned_msg = "New doctor is assigned successfully";
            echo '<script type="text/javascript">
            alert("'.$doctor_assigned_msg.'");
            window.location= "receptionist_home.php";
        </script>';
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}


?>














