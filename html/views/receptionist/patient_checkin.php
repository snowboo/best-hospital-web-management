<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
        <form name="form2" method="post" action="checkpatient.php">
            <td>
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="6"><h1>Patient Check In</h1></td>
                </tr>
                <!-- First name and last name-->
                <tr>
                    <td width="90">First Name</td>
                    <td width="6">:</td>
                    <td width="120"><input class="form-control" name="fname" type="text" id="fname"></td>
                    <td>&nbsp; &nbsp; &nbsp; Last Name</td>
                    <td>:</td>
                    <td><input class="form-control" name="lname" type="text" id="lname"></td>
                </tr>
                <!-- age and address-->
                <tr>
                    <td width="90">Age</td>
                    <td width="6">:</td>
                    <td width="160"><input class="form-control" name="age" type="text" id="age"></td>
                    <td>&nbsp; &nbsp; &nbsp; Address</td>
                    <td>:</td>
                    <td><input class="form-control" name="address" type="text" id="address"></td>
                </tr>
                <!-- sex and care card #-->
                <tr>
                    <td width="90">Sex</td>
                    <td width="6">:</td>
                    <td width="160"><input class="form-control" name="sex" type="text" id="sex"></td>
                    <td>&nbsp; &nbsp; &nbsp; Carecard #</td>
                    <td>:</td>
                    <td><input class="form-control" name="carecardnum" type="text" id="carecardnum"></td>
                </tr>
                <td>&nbsp;</td>
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
</table>