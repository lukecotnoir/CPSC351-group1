<?php
    include_once(realpath("resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="public_html/css/report-page.css" rel="stylesheet">
<body>
    <form action="Reports_system.php" method="post">
        <div class="report-form">
            <div class="title"><p>Report A Problem</p></div>
            <p>*: required</p>
            <div class="type">
                What are you reporting*?:
                <select name = "dropdown">
                    <option value = "Account" selected>Account Problem</option>
                    <option value = "Message">Message</option>
                    <option value = "Post">Post</option>
                    <option value = "Other">Other</option>
                </select>
            </div>
            <div class="details">
                <div class="line">
                    <p>If other, explain:&nbsp</p>
                    <div class="text-box"><input type ='text', name='reportdescribe'></div>
                </div>
                <div class="line">
                    <p>Your CNU ID*:</p>
                    <div class="text-box"><input type = "text" name = "reporterID"></div>
                </div>
                <div class="line">
                    <p>Reason for report:</p>
                    <div class="text-box"><input type = "text" name = "reason"></div>
                </div>
                <div class="button"><input type="submit" name="submit"></div>
            </div>
        </div>
    </form>

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
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
