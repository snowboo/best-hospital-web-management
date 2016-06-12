<?php
include '../../resources/config.php';
include '../../resources/ChromePhp.php';
// ChromePhp::log('Hello console!');
// ChromePhp::log($_SERVER);
// ChromePhp::warn('something went wrong!');

session_start();
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}
?>

<html>
    <body>
        Login Successful
    </body>
</html>
