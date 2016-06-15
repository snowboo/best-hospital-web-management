<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

$myEID = $_SESSION['mypassword'];

$tbl_name="Prescription"; // Table name
$pid = $_POST['pid'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE prescriptionID='$pid';";
$result = $conn->query($sql);


if($pid >= 0) {
	$pid=(int) $pid;
}

if (is_int($pid) == FALSE || $conn->query($sql) === FALSE){
	   $err_not_found = "There is no prescription under this ID for this Patient";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location ="delete_patient.php";
          </script>';

} else if ($conn->query($sql) === TRUE) {
	echo '<script type="text/javascript">
            alert("Record (ID:'.$pid.') deleted successfully");
             window.location= "delete_patient.php"; 
        </script>';
}

?>



