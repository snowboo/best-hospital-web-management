<?php
include '../../resources/config.php';
// include '../../recources/ChromePhp.php';
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
        <br>
        <br>

        Receptionist Homepage

        <br>

        <button><a href="<?php echo 'patient_checkin.php'; ?>"><p>Check In Patient</p>
    	</a></button>
    </body>
</html>