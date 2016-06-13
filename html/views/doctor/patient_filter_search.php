<?php
// session_start();
?>
<?php

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

//TODO AS FUCCCCK
$tbl_name="Patient_Attendedby"; // Table name
$fnamec = $_POST['fnamec'];
$fname = $_POST['fname'];
$lnamec = $_POST['lnamec'];
$lname = $_POST['lname'];
$carecardnum = $_POST['carecardnum'];
$carecardnumc = $_POST['carecardnumc'];
$agec = $_POST['agc'];
$age = $_POST['age'];
$sexc = $_POST['sexc'];
$addressc = $_POST['addressc'];
$operator = $_POST['operator'];

$selectionArray = array($fnamec, $lnamec, $carecardnumc, $agec, $sexc, $addressc);
//Remove empty values from selection array

$select="";
foreach ($selectionArray as $attribute) {
  if (isset($attribute) && !empty($attribute)) {
    $select= $attribute . "," . $select;
  }
  $select = rtrim($select,',');
}

$where="";
//remove empty values from selection array
if (isset($carecardnum) && !empty($carecardnum)) {
  $where = "carecardnum = $carecardnum AND " . $where;
}

//remove empty values from selection array
if (isset($fname) && !empty($fname)) {
  $where = "fname = $fname AND " . $where;
}

//remove empty values from selection array
if (isset($lname) && !empty($lname)) {
  $where = "lname = $lname AND " . $where;
}

//remove empty values from selection array
if (isset($age) && !empty($age) && isset($operator) && !empty($operator)) {
  $where = "age $operator $age AND " . $where;
}
$where = rtrim($where, 'AND ');

$sql = "SELECT $select from $tbl_name WHERE $where";
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



