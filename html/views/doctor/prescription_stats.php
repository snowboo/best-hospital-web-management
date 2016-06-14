<?php
session_start();
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
// include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");
// ChromePhp::log('Hello console!');
// ChromePhp::warn('something went wrong!');

$myEID = $_SESSION['mypassword'];
$patientQuery = "SELECT count(*) as 'Number of Patients' FROM Patient_Attendedby";
$patientResult = $conn->query($patientQuery);

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

// query for all patients
$medicineQuery = "SELECT type,sum(dosage) as 'Sum of Dosage' FROM Prescription GROUP BY type";
$medicineResult = $conn->query($medicineQuery);

$allData = array();
while($allRow = $medicineResult->fetch_assoc()) {
    $allData[] = $allRow;
}

$colNames2 = array_keys(reset($allData));

?>

<h3>Number of Patients</h3>
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

<h3>Drugs Prescribed</h3>
<table border="1">
    <tr>
        <?php
           // print the header
           foreach($colNames2 as $colName) {
              echo "<th> $colName </th>";
           }
        ?>
    </tr>
    <?php
        // print the rows
        foreach($allData as $allRow) {
            echo "<tr>";
            foreach($colNames2 as $colName) {
                echo "<td>".$allRow[$colName]."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>


<form method="post" action="prescription_stats_search.php">
    <h3>Aggregate by:</h3> <br>
    Youngest Patient <input type="radio" name="age" id="age" value="young"> <br/>
    Oldest Patient <input type="radio" name="age" id="age" value="old"> <br/>
    <br/>
    
    <h3>Search Prescription:</h3> <br>
    Number of Prescriptions <input type="radio" name="choice" id="choice" value="1"> <br/>
    Total number of dosages <input type="radio" name="choice" id="choice" value="2"> <br/>
    <input type="submit" name="submit" value="submit">
</form>



<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>
