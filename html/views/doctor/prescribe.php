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
date_default_timezone_set("America/New_York");

// get current patient
$patientCarecard = $_GET['cardnum'];
$patientQuery = "SELECT fname, lname FROM Patient_Attendedby WHERE carecardnum = '$patientCarecard';";
$result = $conn->query($patientQuery);
$row = $result->fetch_assoc();

?>

<h3>Create prescription for: <?php echo ucfirst($row['fname']) . " " . ucfirst($row['lname']); ?> </h3>

<form method="post" action="createprescription.php">
    Medicine:
    <input class="form-control" type="text" name="type" id="type">
    Care card #:
    <input class="form-control" type="text" name="carecardnum" id="carecardnum" value="<?php echo $patientCarecard; ?>">
    Date:
    <input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" />
    <input class="btn btn-success" type="submit" name="submit" value="submit">
    <br>
</form>

<?php
    require_once("../../resources/templates/footer.php");
?>
