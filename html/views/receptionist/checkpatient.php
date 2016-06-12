<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

session_start();

$tbl_name="Patient_Attendedby"; // Table name

//fname, lname, dob, address, sex, carecardnum
$fname	 = $_POST['fname'];
$lname 	 = $_POST['lname'];
$dob	 = $_POST['dob'];
$address = $_POST['address'];
$sex   = $_POST['sex'];
$carecardnum   = $_POST['carecardnum'];

// // To protect MySQL injection
// $fname = stripslashes($fname);
// $lname = stripslashes($lname);
// $sex = stripslashes($sex);
// $carecardnum = stripslashes($carecardnum);

// $fname = $conn->escape_string($fname);
// $lname = $conn->escape_string($lname);
// $sex = $conn->escape_string($sex);
// $carecardnum = $conn->escape_string($carecardnum);

$sql = "
SELECT * 
from $tbl_name 
WHERE fname = '$fname' AND 
lname = '$lname' AND
dob = '$dob' AND 
address = '$address' AND 
sex = '$sex' AND 
carecardnum = '$carecardnum' 
";

$result = $conn->query($sql);

$count = $result->num_rows;
// If result matched $fname, $lname, $dob, $address, $sex, and $carecardnum, table row must be 1 row

//TODO: Check that the patient exists in the db
// count == 1 if the input patient already exist in database
if($count == 1) {
	$error_msg = "This patient already exists in the database";
            echo '<script type="text/javascript">
            alert("'.$error_msg.'");
                window.location= "patient_checkin.php"; 
        </script>';
}
// if the input patient doesn't exist in database, add the patient into the database
else {
	$sql = "
	INSERT INTO $tbl_name (fname, lname, dob, address, sex, carecardnum)
	VALUES ('$fname', '$lname', '$dob', '$address', '$sex', '$carecardnum')
	";

	$new_patient_msg = "This patient is new!";
            echo '<script type="text/javascript">
            alert("'.$new_patient_msg.'");
                window.location= "assign_doctor.php"; 
        </script>';

	// if ($conn->query($sql) === TRUE) {
 //    echo "New patient added successfully";
	// } else {
 //    echo "Error: " . $sql . "<br>" . $conn->error;
	// }

}

?>














