<?php
session_start();
?>

<?php
//include "../../resources/config.php";
//include "../../resources/ChromePhp.php";
include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "nurse") {
  header("location:../../login.php");
}
$sql="SELECT * FROM Room_Assignedto";
$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

$count = $result->num_rows;
?>


<html>
    <body>
    Nurse Homepage

<h3>Room Data</h3>
<table class="table table-hover">
    <tr>
        <?php
           // print the header
           foreach($colNames as $colName) {
              echo "<th> $colName </th>";
           }
        ?>
    </tr>
    <?php
        // print the rows
        foreach($data as $row) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".$row[$colName]."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>
     <form name="assign_room" method="post" action="assign_room.php">
        <td>
          <table>
            <tr> Assign Patient to Room </tr>
            <tr>
              <td> Room Number </td>
              <td><input class="form-control" name="roomnum" type="number" id="roomnum"></td>
            </tr>
            <tr>
              <td> Floor Number </td>
              <td><input class="form-control" name="floornum" type="number" id="floornum"></td>
            </tr>
            <tr>
              <td> Paient CareCard Number </td>
              <td><input class="form-control" name="carecardnum" type="number" id="carecardnum"></td>
            <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input class="btn btn-success" type="submit" name="Submit" value="Assign a room">
                    <button class="btn btn-warning" onclick="history.go(-1);">Cancel </button></td>
            </tr>
          </table>
        </td>
      </form>

    </body>
</html>

<?php
 echo "<br/>";
 require_once("../../resources/templates/footer.php");
?>
