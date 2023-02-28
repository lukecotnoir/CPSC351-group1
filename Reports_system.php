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
                Where is the issue*?:
                <select name = "dropdown">
                    <option value = "Whole site" selected>WholeSite</option>
                    <option value = "Posts">Posts</option>
                    <option value = "My Account">My Account</option>
                    <option value = "Communities">Communities</option>
                    <option value = "Events">Events</option>
                    <option value = "Messages">Messages</option>
                    <option value = "Login">Login</option>
                    <option value = "Search">Search</option>
                    <option value = "Other">Other</option>
                </select>
            </div>
            <div class="details">
                <div class="line">
                    <p>Please provide extra details (If the item has an ID, please provide):&nbsp</p>
                    <div class="text-box"><input type ='text', name='reportdescribe'></div>
                </div>
                <div class="line">
                    <p>Your email*:</p>
                    <div class="text-box"><input type = "text" name = "reporteremail"></div>
                </div>
                <div class="button"><input type="submit" name="submit"></div>
            </div>
        </div>
    </form>

<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
<?php
include_once(realpath("resources/connection.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));    


if(isset($_POST['dropdown'],$_POST['reporteremail']))
{
    $reporttype = $_POST['dropdown'];
    $reporteremail = $_POST['reporteremail'];


    if(isset($_POST["reporterdescribe"]))
    {
        $details = $_POST["reportdescribe"];
    }
    else
    {
        $details = "none";
    }

    #Need to figure out how to create a new ID every time
    $reportID = '00001';

    $sql_insert = "INSERT INTO report_system(RepSys_ID, Account_UserID_Reporter, DropType, Details) 
                    VALUES ('$reportID','$reporteremail','$reporttype', '$details')";

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
