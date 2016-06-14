<?php
session_start();
?>

<?php
//include '../../resources/ChromePhp.php';
//include '../../resources/config.php';
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

$tbl_name1="Patient_Attendedby"; // Table name
$tbl_name2="Prescription";
$tbl_name3="Prescribes";
$age = $_POST["age"];
$choice = $_POST["choice"];

$aggregate;
if ($age == "young") {
  $aggregate = "min(p1.age)";
} else {
  $aggregate = "max(p1.age)";
}

if ($choice = "1") {
  $choice = "sum(p2.dosages)";
} else {
  $choice = "count(p2.type)";
}
//ChromePhp::log($selectionArray);

$sql = "SELECT p1.carecardnum, $choice, from $tbl_name1 p1, $tbl_name2 p2, $tbl_name3 p3
  WHERE p1.carecardnum = p3.carecardnum AND 
  p2.prescriptionID = p3.prescriptionID
  GROUP BY p1.carecardnum 
  HAVING $aggregate";
echo $sql;
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
<table border="1">
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
