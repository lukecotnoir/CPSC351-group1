<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report a problem</title>
</head>
<body>
<form action="Reports_system.php" method="post">
    Creating a report</p>*: required</p>
    What are you reporting*?:
    <select name = "dropdown">
        <option value = "" selected> </option>
        <option value = "Account">Account Problem</option>
        <option value = "Message">Message</option>
        <option value = "Post">Post</option>
        <option value = "Other">Other</option>
    </select>  </p>
If other, please provide extra detail: <input type ='text', name='reportdescribe'> </p>
Your ID*:<input type = "text" name = "reporterID"> </p>
Reason for report:<input type = "text" name = "reason"></p>
<input type="submit" name="submit">
</form><body></html>

<?php
if(isset($_POST['dropdown'],$_POST['reporterID']))
{
    $reporttype = $_POST['dropdown'];
    $reporterID = $_POST['reporterID'];


    if(isset($_POST["reason"]))
    {
        $reason = $_POST["reason"];
    }
    else
    {
        $reason = "none";
    }

echo "Report has been sent to Admin.";


#This is where we will add the report to the table in SQL

}
?>