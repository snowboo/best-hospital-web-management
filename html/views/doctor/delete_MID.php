<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");
$myEID = $_SESSION['mypassword'];

$tbl_name="MedicalRecord_Has"; // Table name
$MID = $_POST['MID'];
$carecardnum= $_POST['carecardnum'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE mid='$MID' AND carecardnum=$carecardnum;";

$result = $conn->query($sql);


if($MID > 0) {
  $MID = (int) $MID;
}

if (is_int($MID) == FALSE || $conn->query($sql) === FALSE){
    echo "Error deleting record: ".$conn->error;
    /*$err_not_found = "This Is Not A Valid Prescription ID";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="delete_MR.php";
          </script>';*/

} else if ($conn->query($sql) === TRUE) {
	echo '<script type="text/javascript">
            alert(Record '.$MID.') deleted successfully");
            window.location="delete_MR.php";
          </script>';
}

?>



