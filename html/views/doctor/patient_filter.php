<?php
session_start();
?>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");

if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}

?>

<form method="post" action="patient_filter_search.php">
    <h3>Select by:</h3> <br>
    First Name <input type="checkbox" name="fnamec" id="fnamec" value="fname"> <br/>
    Last Name <input type="checkbox" name="lnamec" id="lnamec" value="lname"> <br/>
    Carecard Number <input type="checkbox" name="carecardnumc" id="carecardnumc" value="carecardnum"> <br/>
    Age <input type="checkbox" name="agec" id="agec" value="age"> <br/> 
    Gender <input type="checkbox" name="sexc" id="sexc" value="sex"> <br/>
    Address <input type="checkbox" name="addressc" id="addressc" value="address"> <br/>
    <br/>
    <h3>Search by:</h3> <br>
    First name: 
    <input type="text" name="fname" id="fname"> <br/>
    Last name:
    <input type="text" name="lname" id="lname"> <br/>
    Carecard number:
    <input type="text" name="carecardnum" id="carecardnum"> <br/>
    Patient Age:
    "<","=","<",">=", "<=", "<>" <input type="text" name="operator" id="operator" value="<">
    <input type="text" name="age" id="age" value="age">
    <input type="submit" name="submit" value="submit">
</form>

<?php
    echo "<br>";
    require_once("../../resources/templates/footer.php");
?>
