<?php
session_start();
?>
<?php
include '../../resources/ChromePhp.php';
include '../../resources/config.php';

?>

<form method="post" action="patient_byFloor_filter.php">
    Search by Floor #: <br>
    <input type="text" name="floornum" id="floornum">
    <input type="submit" name="submit" value="submit">
</form>



<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>
