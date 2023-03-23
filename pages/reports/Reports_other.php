<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="/CPSC351-GROUP1/public_html/css/report-page.css" rel="stylesheet">
<body>
<div class='report-form'>
    <form action="Reports_other.php" method="post">
        <div class="title"><p>Report something/someone</p></div>
        <hr style="width: 75%">
        <div class='line' style="font-size: 20px; color: red;"><p><?php if(!isset($_SESSION['email'])) echo "Sign in to make a report.";?></p></div>
        <div class="type">
            What are you reporting?:
            <select name = "dropdown">
                <option value = "Account" selected>Account</option>
                <option value = "Post">Post</option>
                <option value = "Community">Community</option>
            </select>
        </div>
        <div class="details">
            <div class="line">
                <label for="otherdetail">Please provide extra details:</label>
            </div>
            <div class='line'>
                <textarea id='otherdetail' name='otherdetail' rows="3" cols="40">Enter details here.</textarea>
            </div>
            <div class="line">
                <p>Email of who or what you are reporting:</p>
                <div class="text-box"><input type ='text', name='rep_ID'></div>
            </div>
            <div class="line">
                <label for="reason">Please explain your reason for reporting:</label>
            </div>
            <div class='line'>
                <textarea id='reason' name='reason' rows="3" cols="40">Enter details here.</textarea>
            </div>
            <div class="button"><input type="submit" name="submit"></div>
        </div>
    </form>
</div>

<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
<?php
include_once(realpath(CONNECTION_PATH));
include_once(realpath(TEMPLATES_PATH . "/header.php"));    


if(isset($_POST['dropdown'],$_SESSION['email']))
{
    $reporttype = $_POST['dropdown'];
    $reporter_ID = $_SESSION['email'];


    if(isset($_POST["otherdetail"]))
    {
        $details = $_POST["otherdetail"];
    }
    else
    {
        $details = "none";
    }

    if(isset($_POST["reason"]))
    {
        $reason = $_POST["reason"];
    }
    else
    {
        $reason = "none";
    }

    if(isset($_POST["rep_ID"]))
    {
        $rep_ID = $_POST["rep_ID"];
    }
    else
    {
        $rep_ID = "none";
    }

    include_once(realpath(TEMPLATES_PATH . "/footer.php"));

    
    if($reporttype=="Account")
    {
        $sql_insert = "INSERT INTO report_other(DropType, OtherDetail, ReporterID, Rep_Acc_ID, Reason) 
        VALUES ('$reporttype', '$details', '$reporter_ID','$rep_ID' , '$reason')";
    }
    if($reporttype=="Post")
    {
        $sql_insert = "INSERT INTO report_other(DropType, OtherDetail, ReporterID, Rep_Post_ID, Reason) 
        VALUES ('$reporttype', '$details', '$reporter_ID','$rep_ID', '$reason')";
    }
    if($reporttype=="Community")
    {
        $sql_insert = "INSERT INTO report_other(DropType, OtherDetail, ReporterID, Rep_Comm_ID, Reason) 
        VALUES ('$reporttype', '$details', '$reporter_ID','$rep_ID', '$reason')";
    }
    /*if($reporttype=="Message")
    {
        $sql_insert = "INSERT INTO report_other(DropType, OtherDetail, ReporterID, Rep_Mess_ID, Reason) 
        VALUES ('$reporttype', '$details', '$reporter_ID','$rep_ID', '$reason')";
    }*/
    
    

    if ($conn->query($sql_insert) === TRUE)
    {
    echo "<br>Your report has been recorded and sent to Admin";
    } 
    else 
    {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
else
{
    echo "<br>Please fill out all required information before submitting.";
}
?>
