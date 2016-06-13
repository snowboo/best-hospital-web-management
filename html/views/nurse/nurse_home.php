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

    <button><a href="room_management.php">Room Management</a></button>
    </body>
</html>
