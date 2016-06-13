<?php
session_start();
//include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
//include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);

include '../../resources/config.php';
include '../../resources/ChromePhp.php';

if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "nurse") {
  header("location:../../login.php");
}
$tbl_name="Room_Assignedto";
$roomnum = $_POST['roomnum'];
$floornum = $_POST['floornum'];
$carecardnum = $_POST['carecardnum'];

//Prevent injection
//$roomnum = stripslashes($roomnum);
//$floornum = stripslashes($floornum);
//$carecardnum = stripslashes($carecardnum);

$sql="
SELECT * 
FROM $tbl_name 
WHERE roomnum=$roomnum 
AND floornum=$floornum
";

$result = $conn->query($sql);

$count = $result->num_rows;

if ($count == 1 && $result->fetch_assoc()['carecardnum'] != $carecardnum) {
// update
  $sql="
UPDATE $tbl_name SET 
roomnum=$roomnum, 
floornum=$floornum,
carecardnum=$carecardnum
WHERE roomnum=$roomnum
AND floornum=$floornum";

$conn->query($sql);
         echo '<script type="text/javascript">
            alert("Successfully updated");
                window.location= "room_management.php"; 
        </script>';

}
else
{
  //insert
  $sql="
    INSERT INTO $tbl_name(floornum,roomnum,carecardnum)
    VALUES ($floornum,$roomnum,$carecardnum)";

    $conn->query($sql);
         echo '<script type="text/javascript">
            alert("Successfully inserted");
                window.location= "room_management.php"; 
        </script>';


}

?>


