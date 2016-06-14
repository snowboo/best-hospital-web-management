<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

$tbl_name="Patient_Attendedby"; // Table name
$carecardnum = $_POST['carecardnum'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE carecardnum = $carecardnum";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

?>



