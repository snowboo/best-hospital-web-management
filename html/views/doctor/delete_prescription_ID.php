<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

$myEID = $_SESSION['mypassword'];

$tbl_name="Prescription"; // Table name
$PID = $_POST['PID'];

// delete a record 
$sql = "DELETE FROM $tbl_name pre WHERE pre.prescriptionID=$PID";
$result = $conn->query($sql);


if($PID >= 0) {
	$PID = (int) $PID;
}

if (is_numeric ($PID) || $conn->query($sql) === FALSE){
	 $err_not_found = "This Is Not A Valid Prescription ID";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="delete_prescription.php";
          </script>';

} else if ($conn->query($sql) === TRUE) {
	echo '<script type="text/javascript">
            alert(Prescription '.$PID.') deleted successfully");
            window.location="delete_prescription.php";
          </script>';
}

?>



