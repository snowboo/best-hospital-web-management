<?php

// include '../../resources/ChromePhp.php';
include '../../resources/config.php';

session_start();
$tbl_name="Patient_Attendedby"; // Table name


//set eid to global variable
$eid = $_POST['eid'];
$_SESSION['eid']= $eid;

//regain the patient information from the checkpatient.php
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$age = $_SESSION['age'];
$address = $_SESSION['address'];
$sex = $_SESSION['sex'];
$carecardnum = $_SESSION['carecardnum'];

// check if eid provided is doctor
$checkDoctorIDQuery = "SELECT eid FROM Doctor WHERE eid = '$eid';";
$doctorResult = $conn->query($checkDoctorIDQuery);

if ($doctorResult->num_rows == 0) {
    $not_doctor_error = "EID provided is not a doctor";
        echo '<script type="text/javascript">
            alert("'.$not_doctor_error.'");
            window.location= "assign_doctor.php";
        </script>';
} else {


    $sql = "
    INSERT INTO $tbl_name (fname, lname, age, address, sex, carecardnum, eid)
    VALUES ('$fname', '$lname', '$age', '$address', '$sex', '$carecardnum', '$eid');";

    $result = $conn->query($sql);

    if ($result) {
        $doctor_assigned_msg = "New doctor is assigned successfully";
            echo '<script type="text/javascript">
                alert("'.$doctor_assigned_msg.'");
                window.location= "receptionist_home.php";
            </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>














