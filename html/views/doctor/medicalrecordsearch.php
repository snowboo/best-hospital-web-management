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

?>

<form method="post" action="checkmedicalrecords.php">
    Search by Carecard #: <br>
    <input class="form-control" type="text" name="carecardnum" id="carecardnum">
    <input class="btn btn-success" type="submit" name="submit" value="submit">
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>