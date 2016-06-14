<?php
session_start();

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

require_once('../../resources/templates/doctorheader.php');
// require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");


if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}
?>
<?php
//include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
// include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");
// ChromePhp::log('Hello console!');
// ChromePhp::warn('something went wrong!');

$myEID = $_SESSION['mypassword'];

//query for my patients
$patientQuery = "SELECT * FROM Patient_Attendedby WHERE eid = '$myEID';";
$patientResult = $conn->query($patientQuery);

$patientCount = $patientResult->num_rows;

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

// query for all patients
$allPatientsQuery = "SELECT * FROM Patient_Attendedby;";
$allResult = $conn->query($allPatientsQuery);

$allData = array();
while($allRow = $allResult->fetch_assoc()) {
    $allData[] = $allRow;
}

$colNames = array_keys(reset($allData));

// query for special attention patients
$specialAttentionQuery = "
SELECT *
FROM Patient_Attendedby PA
WHERE NOT EXISTS
(SELECT PTN.prescriptionID
    FROM Prescription PTN
    WHERE PTN.prescriptionID NOT IN
    (SELECT P.prescriptionID
    FROM Prescribes P
    WHERE P.carecardnum = PA.carecardnum));";

$specialAttentionResult  = $conn->query($specialAttentionQuery);

$specialAttentionData = array();
while($specialAttentionRow = $specialAttentionResult->fetch_assoc()) {
    $specialAttentionData[] = $specialAttentionRow;
}

?>

<h3>My Patients</h3>
<table class="table table-hover">
    <tr>
        <?php
           // print the header
            if ($patientCount < 1) {
                echo "No Patients";
            } else {
               foreach($colNames as $colName) {
                  echo "<th> $colName </th>";
               }
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
            echo "</tr>";
        }
    ?>
</table>

<a class="btn btn-success" href="delete_patient.php">Remove Patient</a>
<a class="btn btn-success" href="delete_prescription.php">Delete Prescrption</a>
<a class="btn btn-success" href="delete_MR.php">Delete Medical Record</a>


<h3>All Patients</h3>
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
        foreach($allData as $allRow) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".ucfirst($allRow[$colName])."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<h3>Patients that Require Special Attention</h3>
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
        foreach($specialAttentionData as $specialAttentionRow) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".ucfirst($specialAttentionRow[$colName])."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<?php
    require_once("../../resources/templates/footer.php");
?>