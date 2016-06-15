<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

$myEID = $_SESSION['mypassword'];

$tbl_name="Prescribes"; // Table name
$pid = $_POST['pid'];
$carecardnum= $_POST['carecardnum'];

// delete a record (the related patient should not be deleted)
// DELETION QUERY (NOT ON CASCADE)
$check = "SELECT * FROM $tbl_name WHERE prescriptionID='$pid' AND carecardnum=$carecardnum;";
$result = $conn->query($check);
$count = $result->num_rows;

if ($count > 0) {
  $sql = "DELETE FROM $tbl_name WHERE prescriptionID='$pid';";

} else {
   $err_not_found = "There is no prescription under this ID for this Patient";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location ="delete_prescription.php";
          </script>';
}

$result = $conn->query($sql);

if($carecardnum > 999 && $carecardnum < 10000) {
  $carecardnum=(int) $carecardnum;
}

if (is_int($carecardnum) == FALSE){
	   $err_not_found = "There is no patient with this carecardnum";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location ="delete_prescription.php";
          </script>';

} else if ($conn->query($sql) === TRUE) {
	echo '<script type="text/javascript">
            alert("Record (ID:'.$pid.') deleted successfully");
             window.location= "delete_prescription.php"; 
        </script>';
}

?>



