<?php
session_start();
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}
if (!isset($_SESSION['carecardnum'])) {
    header("location:medicalrecordsearch.php");
}
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");



$carecardnum = $_SESSION['carecardnum'];
$sql = "SELECT * from MedicalRecord_Has WHERE carecardnum = '$carecardnum'";
$result = $conn->query($sql);

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$colNames = array_keys(reset($data));

?>

<h3>Medical Records</h3>
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