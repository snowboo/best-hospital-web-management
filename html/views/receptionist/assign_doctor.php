<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
        <form name="form3" method="post" action="check_assigndoctor.php">
            <td>
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                    <td colspan="3"><h1>Assign a doctor to this patient</h1></td>
                </tr>
                <!-- Employee ID-->
                <tr>
                    <td width="30">Doctor ID</td>
                    <td width="6">:</td>
                    <td width="100"><input name="eid" type="text" id="eid"></td>
                </tr>

                <td>&nbsp;</td>
                <!--Submit and Cancel button-->
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="submit">
                    <button onclick="history.go(-1);">Cancel </button></td>
                </tr>

                </table>
            </td>
        </form>
    </tr>
</table>