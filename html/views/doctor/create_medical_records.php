<?php
session_start();
?>

<?php

include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");

//Using GET to get carecardnumber for the particular patient
$cardnum = $_GET['cardnum'];
//setting it to be a global variable
$_SESSION['carecardnum'] = $cardnum; 

//medicalRecordQuery for the patient 
$medicalRecordQuery = "
SELECT mid as 'Medical Record ID', medicalStatus as 'Medical Status', carecardnum as CardNo
FROM MedicalRecord_Has 
WHERE carecardnum = '$cardnum';
";

$medicalRecordResult = $conn->query($medicalRecordQuery);

// if (mysqli_num_rows($medicalRecordResult) == 0) { 
//    //results are empty, do something here 
            
// } else { 
//     while($admin_row = mysqli_fetch_array($medicalRecordResult)) { 
//       //processing when you have some data 
//     $data = array();

//     while($row = $medicalRecordResult->fetch_assoc()) {
//     $data[] = $row;
//     }

//     $colNames = array_keys(reset($data));
//     }  
// }

$recordCount = $medicalRecordResult->num_rows;

$data = array();

while($row = $medicalRecordResult->fetch_assoc()) {
    $data[] = $row;
}

if ($recordCount > 0) {
    $colNames = array_keys(reset($data));
}
?>

<div class="col-md-6">
    <h3>Current Medical Status</h3>
    <div class="col-md-12">
        <table class="table table-hover">
            <tr>
                <?php
                //When patient doesn't have a medical record
                if (mysqli_num_rows($medicalRecordResult) == 0) { 
                    echo "This patient doesn't have a medical record";
                } else { 
                    // print the header
                   foreach($colNames as $colName) {
                      echo "<th> $colName </th>";
                   }
            
                }  
                ?>
            </tr>
            <tr>
            <?php
                if (mysqli_num_rows($medicalRecordResult) == 0) { 
                //results are empty, don't do anything
                } else { 
                    // print the header
                   foreach($data as $row) {
                        echo "<tr>";
                        foreach($colNames as $colName) {
                            echo "<td>".ucfirst($row[$colName])."</td>";
                        }
                    echo "</tr>";
                    }
            
                } 
            ?>
            </tr>
        </table>
    </div>


    <h3>Add a new medical status for this patient</h3>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <div class="col-md-6">
        <tr>
            <form name="form2" method="post" action="check_create_medical_records.php">
                <td>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                    <!-- mid and medical status-->
                    <tr>  
                        
                        <td width="50">mid</td>
                        <td width="6">:</td>
                        <td width="60"><input class="form-control" name="mid" type="text" id="mid"></td>
                    </tr>
                    <tr>
                        <td width="50">Medical Status</td>
                        <td width="6">:</td>
                        <td width="60"><input class="form-control" name="medicalStatus" type="text" id="medicalStatus"></td>
                    </tr>
                    <!--Submit and Cancel button--> 
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input class="btn btn-success" type="submit" name="submit" value="Submit">
                        <button class="btn btn-warning" onclick="history.go(-1);">Cancel </button></td>
                    </tr>

                    </table>
                </td>
            </form>
        </tr>
    </div>
</div>

