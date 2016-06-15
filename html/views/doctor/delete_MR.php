<?php
session_start();
?>
<?php
include '../../resources/ChromePhp.php';
include '../../resources/config.php';
require_once('../../resources/templates/doctorheader.php');
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

// check if user is a doctor 
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../html/login.php");
}

$myEID = $_SESSION['mypassword'];

// query for all my patients
$sql = "SELECT m.mid as 'Record ID', pat.fname as 'First Name', pat.lname 'Last Name', pat.carecardnum 'CareCard Number', m.medicalStatus as 'Status' 
        FROM Patient_Attendedby pat, MedicalRecord_Has m
        WHERE pat.carecardnum = m.carecardnum AND $myEID = pat.eid;";

$result = $conn->query($sql);
$count = $result->num_rows;
$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if ($count > 0) {
$colNames = array_keys(reset($data));
}

?>
<h3>My Current Patients's Medical Records</h3>
<table border="1">
    <tr>
        <?php
           // print the header
            if ($count < 1) {
                echo "No Existing Medical Records";
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
                echo "<td>".$row[$colName]."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

</br>
<h3>Delete Medical Records</h3>
<form method="post" action="delete_MID.php">
    Medical Record ID:
    <input type="text" name="MID" id="MID">
    Care Card Number:
    <input type="text" name="carecardnum" id="carecardnum">
    <input type="submit" name="submit" value="submit">
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>