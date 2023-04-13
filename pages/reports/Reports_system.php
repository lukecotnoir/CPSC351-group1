<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
?>
<link href="/CPSC351-GROUP1/public_html/css/report-page.css" rel="stylesheet">
<body>
<div class='report-form'>
    <form action="Reports_system.php" method="post">
        <div class="title"><p>Report A System Problem</p></div>
        <hr style="width: 75%;">
        
        <div class="type">
            Where is the issue?:
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
                <label for='reportdescribe' style="font-size: 18px;"><?php if(isset($_SESSION['email'])) echo "Please provide extra details (If the item has an ID, please provide):"; 
                          else echo "Sign in to make a report.";?></label>
            </div>
            <div class='line'>
                <textarea id='reportdescribe' name='reportdescribe' rows="4" cols="50">Enter details here.</textarea>
            </div>
            <div class="button"><input type="submit" name="submit"></div>
        </div>
<?php
include_once(realpath(CONNECTION_PATH));
include_once(realpath(TEMPLATES_PATH . "/header.php"));    


if(isset($_POST['dropdown'],$_SESSION['email']))
{
    $reporttype = $_POST['dropdown'];
    $reporteremail = $_SESSION['email'];
    
    if(isset($_POST["reportdescribe"]))
    {$details = $_POST["reportdescribe"];}
    else
    {$details = "none";}

    

    $sql_insert = "INSERT INTO report_system(ReporterEmail, DropType, Detail, Status) 
                    VALUES ('$reporteremail','$reporttype', '$details', 'In Progress')";

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
</form>
</div>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
