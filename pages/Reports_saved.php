<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
</head>
<body>
<form action="Reports_saved.php" method="post">
    Creating a report</p>*: required</p>
    What are you reporting*?:
    <select name = "dropdown">
        <option value = "" selected> </option>
        <option value = "Account" selected>Account</option>
        <option value = "Community">Community</option>
        <option value = "Message">Message</option>
        <option value = "Post">Post</option>
        <option value = "Other">Other</option>
    </select>  </p>
If other, please describe in extra detail: <input type ='text', name='reportdescribe'> </p>
Your ID*:<input type = "text" name = "reporterID"> </p>
Who/What are you reporting? Please give the ID of the person or Community*:<input type = "text", name= reportedID></p>
Reason for report:<input type = "text" name = "reason"></p>
<input type="submit" name="submit">
</form>
</body>
</html>

<?php
if(isset($_POST['dropdown'],$_POST['reporterID'],$_POST['reportedID']))
{
    $reporttype = $_POST['dropdown'];
    $reporterID = $_POST['reporterID'];
    $reportedID = $_POST['reportedID'];
    if(isset($_POST["reason"]))
    {   $reason = $_POST["reason"];}
    else
    {   $reason = "";}
    if(isset($_POST["reportdescribe"]))
    {   $detail = $_POST["reportdescribe"];}
    else
    {   $detail = "";}

#This is where we will add the report to the table in SQL


$servername = "localhost";
$username  = "root";
$password = "";
$dbname = "project_testing";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$repID = 1;         #Need to figure out how to create a new ID every time


$sql_insert = "INSERT INTO reports_stuff(ReportID, DropType, OtherDetail, ReporterID, ReportedID, Reason) 
VALUES ('$repID','$reporttype', '$detail', '$reporterID', '$reportedID', '$reason')";

if ($conn->query($sql_insert) === TRUE)
{
 echo "<br>Your report has been recorded and sent to Admin";
} else 
{
echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

}
else
{
    echo "<br>Please fill out all required information before submitting.";
}
?>
