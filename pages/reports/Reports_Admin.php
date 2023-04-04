<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $type         = $_POST['report_type'];
        $status         = $_POST['report_status'];
    }
    if($_SESSION['accType'] != "Admin") {
        header("location:/CPSC351-group1/index.php");
    }
?>
<link href="../../public_html/css/report-page.css" rel="stylesheet">
<div class='report-form'>
    <form action="Reports_Admin.php" method="post">
        <div class = 'title'>Reports Page</div>
        <hr style="width: 75%">     
         <div class="line">Type of Report
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
        
        <div class="line">Status
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
        <div class="button">
            <input type="submit" name="submit">
        </div>
        
    </form>
</div>

<?php
include_once(realpath(CONNECTION_PATH));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['report_type'];
    $status = $_POST['report_status'];
    if ($type =="System" )
    {   $sql_find =  "SELECT * FROM report_system WHERE Status LIKE '$status'";                                                
        $result = $conn->query($sql_find);
        if ($result->num_rows >0)
        {
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Reports in Table:$type with Status: $status</p></div>
            <table border='1'>
            <tr><th>RepSys_ID</th><th>Reporter_Email</th><th>DropType</th><th>Detail</th><th>Status</th></tr>";
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                <td><a href=\"Reports_view.php?RepSys_ID={$row['RepSys_ID']}\">{$row['RepSys_ID']}</a></td>
                <td>{$row['ReporterEmail']}</td>
                <td>{$row['DropType']}</td>
                <td>{$row['Detail']}</td>
                <td>{$row['Status']}</td>
                </tr> ";
            } 
            echo "</table></div>";
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
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Reports in $type with Status: $status</p></div>
            <table border='1'><tr>
            <th>RepOth_ID</th><th>ReporterEmail</th><th>DropType</th><th>Detail</th><th>Status</th>
            </tr>";
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                <td><a href=\"Reports_view.php?RepOth_ID={$row['RepOth_ID']}\">{$row['RepOth_ID']}</a></td>
                <td>{$row['ReporterEmail']}</td>
                <td>{$row['DropType']}</td>
                <td>{$row['Detail']}</td>
                <td>{$row['Status']}</td>
                </tr>";

            }  
            echo "</table></div>";
            
        }
        else {
            echo "<br>There are no results for your search ";
        }
    }
}
/*For Changing a report
Not sure how to remove a post but changing status to complete
After selecting the report they want to change, store the Rep_ID to a local? variable and use it
in the where statement. 
$sql_status_change = "UPDATE report_system SET Status = 'Complete' WHERE RepSys_ID = $working_Rep_ID";

*/
include_once(realpath(TEMPLATES_PATH . "/footer.php"));

?>