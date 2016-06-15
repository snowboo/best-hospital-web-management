<?php
session_start();
?>

<?php
//include '../../resources/ChromePhp.php';
//include '../../resources/config.php';
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

$tbl_name="Patient_Attendedby"; // Table name
$fnamec = $_POST["fnamec"];
$fname = $_POST["fname"];
$lnamec = $_POST["lnamec"];
$lname = $_POST["lname"];
$carecardnum = $_POST["carecardnum"];
$carecardnumc = $_POST["carecardnumc"];
$agec = $_POST["agc"];
$age = $_POST["age"];
$sexc = $_POST["sexc"];
$addressc = $_POST["addressc"];
$operator = $_POST["operator"];

$selectionArray = array($fnamec, $lnamec, $carecardnumc, $agec, $sexc, $addressc);
//Remove empty values from selection array
//ChromePhp::log($selectionArray);

$select="";
foreach ($selectionArray as $attribute) {
  if (isset($attribute) && !empty($attribute)) {
    $select= $attribute . "," . $select;
  }
  $select = rtrim($select,',');
}

if (empty($select) || !isset($select)) {
  $err_not_found = "Please Select a field to project";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="patient_filter.php";
          </script>';

}

$where="";
//remove empty values from selection array
if (isset($carecardnum) && !empty($carecardnum)) {
  $where = "carecardnum = '$carecardnum' AND " . $where;
}

//remove empty values from selection array
if (isset($fname) && !empty($fname)) {
  $where = "fname = '$fname' AND " . $where;
}

//remove empty values from selection array
if (isset($lname) && !empty($lname)) {
  $where = "lname = '$lname' AND " . $where;
}

//remove empty values from selection array
if (isset($age) && !empty($age) && isset($operator) && !empty($operator)) {
  $where = "age $operator $age AND " . $where;
}
$where = rtrim($where, 'AND ');

if (empty($where) || !isset($where)) {
  $err_not_found = "Please Select a filter";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="patient_filter.php";
          </script>';

}

$sql = "SELECT $select from $tbl_name WHERE $where";
$result = $conn->query($sql);
$data = array();

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

$count = $result->num_rows;

if ($count >= 1) {

} else {
    $err_not_found = "No patient found with selected attributes";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="patient_filter.php";
          </script>';
}

?>

<h3>Found Patients</h3>
<table class="table table-hover">
    <tr>
        <?php
           // print the header
           foreach($colNames as $colName) {
              echo "<th> $colName </th>";
           }
        ?>
    </tr>
    <?php
        // print the rows
        foreach($data as $row) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".$row[$colName]."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>
