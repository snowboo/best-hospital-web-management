<?php
// session_start();
?>
<?php
include '../../resources/ChromePhp.php';
include '../../resources/config.php';

$tbl_name1="Patient_Attendedby"; // Table 1 name
$tbl_name2="Room_Assignedto"; // Table 2 name
$floornum = $_POST['floornum'];

$sql = "SELECT COUNT(t1.carecardnum) from $tbl_name1 t1, $tbl_name2 t2 WHERE t2.floornum=$floornum AND t1.carecardnum=t2.carecardnum;";
$result = $conn->query($sql);
$count = $result->num_rows;

if($floornum > 0 && $floornum < 4) {
	$floornum = (int) $floornum;
}

if (is_int($floornum) == FALSE){
    $err_not_found = "This Is Not A Valid Floor";
    echo '<script type="text/javascript">
            alert("'.$err_not_found.'");
            window.location="patient_byFloor_search.php";
          </script>';

} else if ($count == 0) {
           echo '<script type="text/javascript">
            alert("No Patient on This Floor");
                window.location= "patient_byFloor_search.php"; 
        </script>';

} else if ($count > 0) {
// show number of patients 
	echo '<script type="text/javascript">
            alert(" There Are'.$count.' Patient(s) On This Floor");
            window.location="patient_byFloor_search.php";
          </script>';
}

?>