<?php
include '../../resources/config.php';
include '../../ChromePhp.php';
// ChromePhp::log('Hello console!');
// ChromePhp::log($_SERVER);
// ChromePhp::warn('something went wrong!');

session_start();
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "receptionist") {
    header("location:../../login.php");
}
?>

<html>
    <body>
        Login Successful as receptionist
    </body>
</html>
