<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

//TODO AS FUCCCCK
$tbl_name="Patient_Attendedby"; // Table name
$carecardnum = $_POST['carecardnum'];

$sql = "SELECT * from $tbl_name WHERE carecardnum = '$carecardnum'";
$result = $conn->query($sql);
$count = $result->num_rows;

if ($count >= 1) {
    $_SESSION['carecardnum'] = $carecardnum;
    header('location:medicalrecords.php');
} else {
    $err_not_found = "No patient found with carecard # " . $carecardnum;
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="medicalrecordsearch.php";
          </script>';
}

?>



