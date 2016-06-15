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

if ((!isset($roomnum) || empty($roomnum)) ||
  (!isset($floornum) || empty($floornum)) ||
  (!isset($carecardnum) || empty($carecardnum))) {
     echo '<script type="text/javascript">
         alert("Please enter all three fields");
         window.location= "room_management.php"; 
        </script>';
}

$sql="select * from Room_Assignedto r, Patient_Attendedby p2 where
 r.roomnum = $roomnum AND
 floornum = $floornum AND
 p2.carecardnum = $carecardnum";
$result = $conn->query($sql);

$count = $result->num_rows;

if ($count == 0) {
           echo '<script type="text/javascript">
            alert("Patient Not Found");
                window.location= "room_management.php"; 
        </script>';
} 

//See if patient is already in a room
$sql="select * from Room_Assignedto r WHERE
  r.carecardnum=$carecardnum";

$result = $conn->query($sql);
$count = $result->num_rows;

if ($count == 1) {
  //Set the current room where the patient is at to null

  $rowData = $result->fetch_assoc();
  $oldRoom = $rowData['roomnum'];
  $oldFloor = $rowData['floornum'];

  $sql="UPDATE $tbl_name SET
    carecardnum=NULL WHERE
    floornum=$oldFloor AND
    roomnum=$oldRoom";
  $conn->query($sql);

}

$sql="UPDATE $tbl_name SET
    carecardnum=$carecardnum WHERE
    floornum=$floornum AND
    roomnum=$roomnum";
  $conn->query($sql);

  if ($conn->query($sql)===TRUE) {
    echo '<script type="text/javascript">
         alert("Successfully updated");
         window.location= "room_management.php"; 
        </script>';
  } else {
    echo '<script type="text/javascript">
         alert("Update Failed");
         window.location= "room_management.php"; 
        </script>';
  }
?>


