<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="/CPSC351-GROUP1/public_html/css/report-page.css" rel="stylesheet">
<body>
    <form action="Reports_other.php" method="post">
        <div class="report-form">
            <div class="title"><p>Report something/someone</p></div>
            <p>*: required</p>
            <div class="type">
                What are you reporting*?:
                <select name = "dropdown">
                    <option value = "Account" selected>Account</option>
                    <option value = "Post">Post</option>
                    <option value = "Community">Community</option>
                </select>
            </div>
            <div class="details">
                <div class="line">
                    <p>Please provide extra details:&nbsp</p>
                    <div class="text-box"><input type ='text', name='otherdetail'></div>
                </div>
                <div class="line">
                    <p>Email or ID of who or what you are reporting:&nbsp</p>
                    <div class="text-box"><input type ='text', name='rep_ID'></div>
                </div>
                <div class="line">
                    <p>Your Email*:</p>
                    <div class="text-box">&nbsp;<?php echo $_SESSION['email'];?></p></div>
                </div>
                <div class="line">
                    <p>Please explain your reason for reporting:</p>
                    <div class="text-box"><input type = "text" name = "reason"></div>
                </div>
                <div class="button"><input type="submit" name="submit"></div>
            </div>
        </div>
    </form>

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
