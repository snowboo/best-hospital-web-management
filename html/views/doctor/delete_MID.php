<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");
$myEID = $_SESSION['mypassword'];

$tbl_name="MedicalRecord_Has"; // Table name
$mid = $_POST['mid'];
$carecardnum= $_POST['carecardnum'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE mid='$mid' AND carecardnum=$carecardnum;";

$result = $conn->query($sql);


if($mid >= 0) {
  $mid=(int) $mid;
}

if (is_int($MID) == FALSE || $conn->query($sql) === FALSE){
    $err_not_found = "There is no valid medical record under this ID for this patient";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location ="delete_patient.php";
          </script>';

} else if ($conn->query($sql) === TRUE) {
	echo '<script type="text/javascript">
            alert("Record (ID: '.$mid.') deleted successfully");
             window.location= "delete_patient.php"; 
        </script>';
}
?>



