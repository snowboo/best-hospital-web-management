<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

$tbl_name="Patient_Attendedby"; // Table name
$carecardnum = $_POST['carecardnum'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE carecardnum='$carecardnum';";
$result = $conn->query($sql);

if($carecardnum > 999 && $carecardnum < 10000) {
	$carecardnum=(int) $carecardnum;
}

if (is_int($carecardnum) == FALSE || $conn->query($sql) === FALSE){
   echo "Error deleting record: ".$conn->error;
    /*$err_not_found = "No Existing Patient With This Care Card Number or Is Invalid";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location ="delete_patient.php";
          </script>';*/

} else if ($conn->query($sql) === TRUE) {
    echo '<script type="text/javascript">
            alert("Record (Patient '.$carecardnum.') deleted successfully");
             window.location= "delete_patient.php"; 
        </script>';
} 
?>



