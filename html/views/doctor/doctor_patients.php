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
$patientQuery = "SELECT fname as 'First Name', lname as 'Last Name', pa.carecardnum as CardNo, count(*) as '# Prescriptions'
FROM Patient_Attendedby pa, Prescribes p
WHERE pa.eid = '$myEID' AND p.carecardnum = pa.carecardnum
GROUP BY pa.carecardnum
UNION
SELECT fname, lname, pa1.carecardnum, 0
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
           echo "<th>" . "Prescribe" . "</th>";
           echo "<th>" . "Medical Record" . "</th>";
        ?>
    </tr>
    <?php
        // print the rows
        $index = 0;
        foreach($data as $row) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".ucfirst($row[$colName])."</td>";

            }
            // save each patient into the session
            $_SESSION[$index . "_" . 'carecardnum'] = $row['CardNo'];
            echo "<td>"."<a href='/views/doctor/prescriptions.php' class='btn btn-success'>Prescribe</a>" ."</td>";
            echo "<td>"."<a class='btn btn-warning'>New Record</a>" ."</td>";
            echo "</tr>";
            $index++;
        }
        // echo drake and john's care card numbers
        echo $_SESSION['0_carecardnum'];
        echo $_SESSION['1_carecardnum'];
    ?>
</table>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>