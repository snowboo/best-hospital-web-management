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

// query for all my patients
$sql = "SELECT ps.prescriptionID as 'P.ID', pat.fname as 'First Name', pat.lname 'Last Name', pat.carecardnum 'CareCard Number', p.drugID 'Drug ID', p.dosage 'Dosage',ps.loggedDate 'Date'
         FROM Patient_Attendedby pat, Prescribes ps, Prescription p 
        WHERE pat.carecardnum = ps.carecardnum AND $myEID = ps.eid AND ps.prescriptionID = p.prescriptionID;";

$result = $conn->query($sql);
$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$colNames = array_keys(reset($data));

?>
<h3>My Current Patients's Perscriptions</h3>
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
<h3>Delete Prescription</h3>
<form method="post" action="delete_prescription_ID.php">
    Perscription ID:
    <input type="number" name="PID" id="PID">
    Care Card Number:
    <input type="number" name="carecardnum" id="carecardnum">
    <input type="submit" name="submit" value="submit">
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>