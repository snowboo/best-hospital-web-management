<?php
session_start();
?>

<?php
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include ($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");

if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:/login.php");
}

$myEID = $_SESSION['mypassword'];
$carecardnum = $_POST['carecardnum'];
$medType = $_POST['type'];
$date = $_POST['date'];

$sql = "SELECT type, prescriptionID FROM Prescription WHERE type = '$medType';";

$result = $conn->query($sql);
$count = $result->num_rows;
$row = $result->fetch_assoc();
$pid = $row['prescriptionID'];

$checkPatientPrescriptions = "SELECT * FROM Prescribes
    WHERE carecardnum = '$carecardnum'
    AND prescriptionID = '$pid';";

$patientPrescriptionResult = $conn->query($checkPatientPrescriptions);
$countPrescriptionID = $patientPrescriptionResult->num_rows;

if ($count == 1) {

    if ($countPrescriptionID > 0) {
        $error = "Patient already has this medicine";
        echo '<script type="text/javascript">
                alert("'.$error.'");
                window.location= "prescribe.php?cardnum='.$carecardnum.'";
            </script>';
    } else {

        $prescribeQuery = "INSERT INTO Prescribes
        values ($myEID, $pid, $carecardnum, '$date');";
        $conn->query($prescribeQuery);
        $msg = "Prescibed " . $medType;
        // echo $date;
        // echo $prescribeQuery;
        echo '<script type="text/javascript">
                alert("'.$msg.'");
                window.location= "prescribe.php?cardnum='.$carecardnum.'";
            </script>';
    }

} else {
    $error_not_found_msg = "Medicine not found";
    echo '<script type="text/javascript">
            alert("'.$error_not_found_msg.'");
            window.location= "prescribe.php?cardnum='.$carecardnum.'";
        </script>';
}

?>

