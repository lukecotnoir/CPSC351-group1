<html><body>
<form action="Reports_system.php" method="post">
    Creating a report</p>*: required</p>
    What are you reporting*?:
    <select name = "dropdown">
        <option value = "" selected> </option>
        <option value = "SystemProblem" selected>System Problem</option>
        <option value = "Account">Account Problem</option>
        <option value = "Message">Message</option>
        <option value = "Post">Post</option>
        <option value = "Other">Other</option>
    </select>  </p>
If other, please describe what: <input type ='text', name='reportdescribe'> </p>
Your ID*:<input type = "text" name = "reporterID"> </p>
Reason for report:<input type = "text" name = "reason"></p>
<input type="submit" name="submit">
</form><body></html>

<?php
if(isset($_POST['dropdown'],$_POST['reporterID']))
{
    $reporttype = $_POST['dropdown'];
    $reporterID = $_POST['reporterID'];
}

if(isset($_POST["reason"]))
{
    $reason = $_POST["reason"];
}
else{
    $reason = "";
}

echo "Report has been sent to Admin.";


#This is where we will add the report to the table in SQL


?>
