<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    
?>
<link href="../../public_html/css/report-page.css" rel="stylesheet">
<form action="Reports_Admin.php" method="post">
<div class = 'title'>Reports Page</div>
 <div class="report-form">
    <div class = "two-items" >       
        <div class="line">
            <div class="select">
                <div class="searchtype">
                    <input type="radio" id="system" name="report_type" value="System" checked="checked">
                    <label for="system">System</label>
                </div>
                <div class="searchtype">
                    <input type="radio" id="other" name="report_type" value="Other">
                    <label for="other">Problem</label>
                </div>
           </div>
        </div>
        
        <div class="line">
            <div class="select">
                <div class="searchtype">
                    <input type="radio" id="finished" name="report_status" value="Completed">
                    <label for="finished">Completed</label>
                </div>
                <div class="searchtype">
                    <input type="radio" id="current" name="report_status" value="In Progress" checked="checked">
                    <label for="current">In Progress </label>
                </div>
           </div>
        </div>
    </div>
        <div class="button">
            <input type="submit" name="submit">
        </div>
        
    </form>
</div>

<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
<?php
include_once(realpath(CONNECTION_PATH));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $type= $_POST['report_type'];
    $status= $_POST['report_status'];
}

if ($type =="System" )
{   
    echo "$type Reports";
    $sql_find =  "SELECT * FROM report_system WHERE Status LIKE '$status'";                                                
    $result = $conn->query($sql_find);
    if ($result->num_rows >0)
    {
        echo "<br>Here are the $type Reports with Status:$status<br>";
        echo "<table border='1'>
        <tr>
        <th>RepSys_ID</th><th>Reporter_Email</th><th>DropType</th><th>Details</th><th>Status</th>
        </tr>
        ";
        while($row = $result->fetch_assoc())
        {   echo "<tr>
                    <td>{$row['RepSys_ID']}</td>
                    <td>{$row['ReporterEmail']}</td>
                    <td>{$row['DropType']}</td>
                    <td>{$row['Details']}</td>
                    <td>{$row['Status']}</td>
                  </tr> ";
        } 
        echo "</table>";
    }
	else {
		echo "<br>There are no filed reports with those requirements";
	}
    
}
if ($type == "Other")
{
    echo "$type Reports";

    $sql_find =  "SELECT * FROM report_other WHERE Status LIKE '$status' ";
                                               
    $result = $conn->query($sql_find);
    if ($result->num_rows >0)
    {   echo "<br>Here are the $type Reports with Status:$status<br>";
        echo "<table border='1'><tr>
        <th>RepOth_ID</th><th>ReporterEmail</th><th>DropType</th><th>Detail</th><th>Status</th>
        </tr>";
        while($row = $result->fetch_assoc())
        {   echo "<tr>
            <td>{$row['RepOth_ID']}</td>
            <td>{$row['ReporterEmail']}</td>
            <td>{$row['DropType']}</td>
            <td>{$row['Detail']}</td>
            <td>{$row['Status']}</td>
            </tr>";

        }  
        echo "</table>";
        if ($email === $row['Email'] and $pass === $row['Password']) {
            #want the ID in the table of reports to be clickable and then set these variables
            $_SESSION['RepOth_ID']    = $row['RepOth_ID'];
            $_SESSION['ReporterEmail']    = $row['ReporterEmail'];
            $_SESSION['DropType']    = $row['DropType'];
            $_SESSION['Detail']  = $row['Detail'];
            $_SESSION['Rep_Acc_ID']   = $row['Rep_Comm_ID'];
            $_SESSION['Rep_Mess_ID']  = $row['Rep_Mess_ID'];
            $_SESSION['Rep_Post_ID']    = $row['Rep_Post_ID'];
            $_SESSION['Reason']    = $row['Reason'];
            $_SESSION['Status']     = $row['Status'];

    header("Location: ../../index.php");
}
    }
	else {
		echo "<br>There are no results for your search ";
	}
}

/*For Changing a report
Not sure how to remove a post but changing status to complete
After selecting the report they want to change, store the Rep_ID to a local? variable and use it
in the where statement. 
$sql_status_change = "UPDATE report_system SET Status = 'Complete' WHERE RepSys_ID = $working_Rep_ID";

*/



if ($email === $row['Email'] and $pass === $row['Password']) {
    $_SESSION['RepSys_ID']    = $row['RepSys_ID'];
    $_SESSION['ReporterEmail']    = $row['ReporterEmail'];
    $_SESSION['DropType']    = $row['DropType'];
    $_SESSION['Detail']  = $row['Detail'];
    $_SESSION['Status']     = $row['Status'];

    header("Location: ../../index.php");
}


?>