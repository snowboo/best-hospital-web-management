<?php
session_start();
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}

$myEID = $_SESSION['mypassword'];
// $patientQuery = "SELECT * FROM Patient_Attendedby WHERE eid = '$myEID'";
$patientQuery = "SELECT fname, lname, sex, p.carecardnum, count(*) as '# Prescriptions'
FROM Patient_Attendedby pa, Prescribes p
WHERE pa.eid = '$myEID' AND pa.carecardnum = p.carecardnum
GROUP BY p.carecardnum;
";
$patientResult = $conn->query($patientQuery);

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

$numPrescriptionsQuery =
"SELECT fname, lname, count(*) as Prescriptions
FROM Patient_Attendedby pa, Prescribes p
WHERE pa.eid = '$myEID' AND pa.carecardnum = p.carecardnum
GROUP BY p.carecardnum;
"

?>

<h3>My Patients</h3>
<table class="table">
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