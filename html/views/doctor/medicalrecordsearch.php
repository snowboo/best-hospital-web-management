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
    <h4>Search by Carecard #:</h4>
    <div class="col-md-3">
        <input class="form-control" type="text" name="carecardnum" id="carecardnum">
    </div>
    <div class="col-md-2">
        <input class="btn btn-success" type="submit" name="submit" value="submit">
    </div>
    <br>
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>