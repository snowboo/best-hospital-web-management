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

?>

<?php
    require_once("../../resources/templates/footer.php");
?>