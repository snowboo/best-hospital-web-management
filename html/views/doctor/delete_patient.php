<?php
session_start();
?>
<?php
include '../../resources/ChromePhp.php';
include '../../resources/config.php';
require_once('../../resources/templates/doctorheader.php');

// check if user is a doctor 
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../html/login.php");
}

$myEID = $_SESSION['mypassword'];
$patientQuery = "SELECT fname as 'First Name', lname as 'Last Name', age as 'Age',
                        sex as 'Sex', carecardnum as 'Care Card Number', eid as 'Doctor ID'
                    FROM Patient_Attendedby 
                    WHERE eid='$myEID';";
$patientResult = $conn->query($patientQuery);

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

// query for all patients
$allPatientsQuery = "SELECT * FROM Patient_Attendedby";
$allResult = $conn->query($allPatientsQuery);

$allData = array();
while($allRow = $allResult->fetch_assoc()) {
    $allData[] = $allRow;
}

?>
<h3>My Current Patients</h3>
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

</br>
<h3>Remove Patient</h3>
<form method="post" action="delete_patient_CCNo.php">
    CareCard Number:
    <input type="text" name="carecardnum" id="carecardnum">
    <input type="submit" name="submit" value="submit">
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>