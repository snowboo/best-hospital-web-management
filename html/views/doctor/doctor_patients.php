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
$patientCount = $patientResult->num_rows;
$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

if ($patientCount > 0) {
    $colNames = array_keys(reset($data));
}

//fname, lname, age, address, sex, carecardnum
$fname   = $_POST['fname'];
$lname   = $_POST['lname'];
$age     = $_POST['age'];
$address = $_POST['address'];
$sex   = $_POST['sex'];
$carecardnum   = $_POST['carecardnum'];

//Store as global variables
$_SESSION['fname']= $fname;
$_SESSION['lname']= $lname;
$_SESSION['age']= $age;
$_SESSION['address']= $address;
$_SESSION['sex']= $sex;
$_SESSION['carecardnum']= $carecardnum;

?>

<h3>My Patients</h3>
<table class="table">
    <tr>
        <?php
           // print the header
            if ($patientCount == 0) {
                echo 'No Patients';
            } else {
               foreach($colNames as $colName) {
                  echo "<th> $colName </th>";
               }
               echo "<th>" . "Prescribe" . "</th>";
               echo "<th>" . "Medical Record" . "</th>";
            }
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
            // TODO: remove these sessions if not used (currently passing values through URL)
            $_SESSION[$index . "_" . 'carecardnum'] = $row['CardNo'];
            echo "<td>"."<a href='/views/doctor/prescribe.php?cardnum=". $row['CardNo'] . "'" . " class='btn btn-success'>Prescribe</a>" ."</td>";
            echo "<td>"."<a href='/views/doctor/create_medical_records.php?cardnum=". $row['CardNo'] . "'" . " class='btn btn-warning'>New Record</a>" ."</td>";
            echo "</tr>";
            $index++;
        }
    ?>
</table>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>