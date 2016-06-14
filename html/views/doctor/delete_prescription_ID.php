<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

$tbl_name="Prescribes"; // Table name
$PID = $_POST['PID'];

// delete a record 
$sql = "DELETE FROM $tbl_name WHERE prescriptionID = PID";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

?>



