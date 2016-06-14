<?php
include($_SERVER['DOCUMENT_ROOT'] . "/resources/config.php");
include($_SERVER['DOCUMENT_ROOT'] . "/resources/ChromePhp.php");

//include '../../resources/config.php';
//include '../../resources/ChromePhp.php';

session_start();
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "nurse") {
  header("location:../../login.php");
}
?>


<html>
    <body>
    Nurse Homepage

    <a class="btn btn-success" href="room_management.php">Room Management</a>
    </body>
</html>

<?php
  echo "<br/>";
  require_once("../../resources/templates/footer.php");
?>
