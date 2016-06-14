<?php
include '../../resources/config.php';
// include '../../resources/ChromePhp.php';
// ChromePhp::log('Hello console!');
// ChromePhp::log($_SERVER);
// ChromePhp::warn('something went wrong!');

session_start();
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "receptionist") {
    header("location:../../login.php");
}

$receptionistEmail = $_SESSION['myusername'];
$receptionistEmail = $conn->escape_string($receptionistEmail);
$receptionistQuery = "SELECT * FROM Employee WHERE email = '$receptionistEmail'";
$result = $conn->query($receptionistQuery);
$employeeRow = $result->fetch_assoc();

?>

<html>
    <body>

        <h2>Receptionist Dashboard</h2>
        <h3><?php echo "Welcome " . ucfirst($employeeRow['fname']) . " " . ucfirst($employeeRow['lname']); ?></h3>


        <br>

        <a class="btn btn-primary" href="<?php echo 'patient_checkin.php'; ?>">Check In Patient</a>
    </body>
</html>

<?php
echo "<br>";
require_once("../../resources/templates/footer.php");
?>
