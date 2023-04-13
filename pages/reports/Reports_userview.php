<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $type         = $_POST['report_type'];
    }
?>
<link href="../../public_html/css/report-page.css" rel="stylesheet">
<div class='report-form'>
    <form action="Reports_userview.php" method="post">
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
        
        <div class="button">
            <input type="submit" name="submit">
        </div>

<?php
include_once(realpath(CONNECTION_PATH));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $type = $_POST['report_type'];
    if ($type =="System" )
    {   $sql_find =  "SELECT * FROM report_system WHERE ReporterEmail = '$email'";                                                
        $result = $conn->query($sql_find);
        if ($result->num_rows >0)
        {
            echo "</form></div>";
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Reports in Table:$type</p></div>
            <table border='1'>
            <tr><th>Report ID</th><th>Drop Type</th><th>Detail</th><th>Status</th></tr>";
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                <td>{$row['RepSys_ID']}</td>
                <td>{$row['DropType']}</td>
                <td>{$row['Detail']}</td>
                <td>{$row['Status']}</td>
                </tr> ";
            } 
            echo "</table></div>";
        }
        else {
            echo "<br>You have not filed any reports";
        }
        
    }
    if ($type == "Other")
    {
        $sql_find =  "SELECT * FROM report_other WHERE ReporterEmail = '$email'";
                                                
        $result = $conn->query($sql_find);
        if ($result->num_rows >0){  
            echo "</form></div>"; 
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Reports in $type</p></div>
            <table border='1'><tr>
            <th>Report ID</th><th>Drop Type</th><th>Detail</th><th>Status</th>
            </tr>";
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                <td>{$row['RepOth_ID']}</td>
                <td>{$row['DropType']}</td>
                <td>{$row['Detail']}</td>
                <td>{$row['Reason']}</td>
                <td>{$row['Status']}</td>
                </tr>";

            }  
            echo "</table></div>";
            
        }
        else {
            echo "<br>You have not filed any reports ";
            echo "</form></div>";
        }
    }
}
else {
    echo "</form></div>";
}
?>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));

?>