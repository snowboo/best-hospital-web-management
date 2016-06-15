<?php
session_start();
?>

<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

$tbl_name="MedicalRecord_Has"; // Table name


//set mid and medicalStatus to global variable
$mid = $_POST['mid'];
$_SESSION['mid']= $mid;

$medicalStatus = $_POST['medicalStatus'];
$_SESSION['medicalStatus']= $medicalStatus;

//regain the patient information from the create_medical_records.php
$carecardnum = $_SESSION['carecardnum'];


//SQL query to update the table by assigning a doctor eid to the particular patient
$sql = "
INSERT INTO $tbl_name (mid, medicalStatus, carecardnum) 
VALUES ('$mid', '$medicalStatus', '$carecardnum')
";

$result = $conn->query($sql);

	// $new_medical_record_msg = "New Medical Record has been created";
 //            echo '<script type="text/javascript">
 //            alert("'.$new_medical_record_msg.'");
 //            window.location= "doctor_patients.php";
 //        </script>';

     $testCount = $result->num_rows;

if ($testCount > 0) {
    $new_medical_record_msg = "New Medical Record has been created";
            echo '<script type="text/javascript">
            alert("'.$new_medical_record_msg.'");
            window.location= "doctor_patients.php";
        </script>';
}
else {
	$error_msg = "Choose a different Medical Record ID";
            echo '<script type="text/javascript">
            alert("'.$error_msg.'");
            window.location= "doctor_patients.php";
        </script>';
}
?>














