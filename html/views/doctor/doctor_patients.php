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
$patientQuery = "SELECT fname as 'First Name', lname as 'Last Name', sex as Sex, count(*) as '# Prescriptions'
FROM Patient_Attendedby pa, Prescribes p
WHERE pa.eid = '$myEID' AND p.carecardnum = pa.carecardnum
GROUP BY pa.carecardnum
UNION
SELECT fname, lname, pa1.sex, 0
FROM Patient_Attendedby pa1, Prescribes p1
WHERE pa1.eid = '$myEID' AND pa1.carecardnum NOT IN (SELECT p2.carecardnum FROM Prescribes p2);";
$patientResult = $conn->query($patientQuery);

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

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
                echo "<td>".ucfirst($row[$colName])."</td>";
            }
            echo "<td>"."<button class='btn btn-success'>Prescribe</button>" ."</td>";
            echo "<td>"."<button class='btn btn-warning'>New Record</button>" ."</td>";
            echo "</tr>";

        }
    ?>
</table>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>