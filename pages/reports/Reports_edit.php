<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if(!isset($_SESSION['email'])) {
    header("location:/CPSC351-group1/index.php");
}
?>

<link href="../../public_html/css/report-page.css" rel="stylesheet">


<?php 
    // include_once(realpath(CONNECTION_PATH));
    // if (isset($_GET['RepOth_ID']))
    // {   
    //     $RepOth_ID = $_GET['RepOth_ID'];
    //     $sql_find =  "SELECT * FROM report_other WHERE RepOth_ID = '$RepOth_ID' ";                              
    //     $result = $conn->query($sql_find);
    //     if ($result->num_rows >0)
    //     {   while($row = $result->fetch_assoc())
    //         {   $table = 'report_other';
    //             $ReporterEmail = $row['ReporterEmail'];
    //             $DropType = $row['DropType'];
    //             $Detail = $row['Detail'];
    //             $Status = $row['Status'];   
    //             if(isset($row['Rep_Acc_ID']))
    //             {$Rep_ID = $row['Rep_Acc_ID'];}
    //             if(isset($row['Rep_Comm_ID']))
    //             {$Rep_ID = $row['Rep_Comm_ID'];}
    //             if(isset($row['Rep_Mess_ID']))
    //             {$Rep_ID = $row['Rep_Mess_ID'];}
    //             if(isset($row['Rep_Post_ID']))
    //             {$Rep_ID = $row['Rep_Post_ID'];}

    //         } 
    //         echo "</div>
    //         <br>Status is set to $Status<br>
    //         <div class='line'>"; 
    //     }
    // }

    
?> 
<div class="report-form">
    <form action="Reports_edit.php?RepSys_ID=<?php echo $_GET['RepSys_ID']?>" method="post">
    <div class="title">
        <p>Report Edit&nbsp;</p>
    </div>
    <hr style="width: 75%">

    <div class="typeSelect">
        <div class="line">
            <input type="radio" id="status_progress" name="status_new" value="In Progress">
            In Progress
        </div>
        <div class="line">
            <input type="radio" id="status_complete" name="status_new" value="Complete">
            Complete
        </div>
    </div>
    <div class = "line">
        <div class="button"><input type="submit" name="submit" value="Submit Changes"></div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include_once(realpath(CONNECTION_PATH));
    $status_new = $_POST['status_new'];
    $sql_update = "UPDATE Report_System SET Status = '".$status_new."' WHERE RepSys_ID = '".$_GET['RepSys_ID']."'";
    $result2 = mysqli_query($conn, $sql_update);
    if ($result2){
        echo "<script>location.href = '/CPSC351-group1/pages/reports/Reports_Admin.php';</script>";
    }
    else {
        die ("The error is: " . mysqli_error($conn));
    }
}
?>
</form>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>