<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if(!isset($_SESSION['email'])) {
    header("location:/CPSC351-group1/index.php");
}
?>
<link href="../../public_html/css/account.css" rel="stylesheet">
<div class=account_info>
    <div class=title>
        <p>Report View&nbsp;</p>
    </div>
    <hr style="width: 75%">

    <?php 
    include_once(realpath(CONNECTION_PATH));
    if (isset($_REQUEST['RepOth_ID']))
    {
        $RepOth_ID1 = $_REQUEST['RepOth_ID'];
        $sql_find =  "SELECT * FROM report_other WHERE RepOth_ID = '$RepOth_ID1' ";                              
        $result = $conn->query($sql_find);
        if ($result->num_rows >0)
        {   while($row = $result->fetch_assoc())
            {   $ReporterEmail = $row['ReporterEmail'];
                $DropType = $row['DropType'];
                $Detail = $row['Detail'];
                $Status = $row['Status'];   
                if(isset($row['Rep_Acc_ID']))
                {$Rep_ID = $row['Rep_Acc_ID'];}
                if(isset($row['Rep_Comm_ID']))
                {$Rep_ID = $row['Rep_Comm_ID'];}
                if(isset($row['Rep_Mess_ID']))
                {$Rep_ID = $row['Rep_Mess_ID'];}
                if(isset($row['Rep_Post_ID']))
                {$Rep_ID = $row['Rep_Post_ID'];}
            }  
            echo "  
            <div class = two-items>
                <div class = line><p>Report Type:</p></div>
                <div class = line><p>Report Other</p></div>
            </div>
            <div class=two-items>
                <div class=line><p>Report ID:</p></div>
                <div class=line><p>".$RepOth_ID1."</p></div>
            </div>
            <div class=two-items>
                <div class=line><p>Reporter Email:</p></div>
                <div class=line><p>".$ReporterEmail."</p></div>
            </div>
            <div class=two-items>
                    <div class=line><p>Drop Type:</p></div>
                    <div class=line><p>".$DropType."</p></div>
            </div>
            <div class=two-items>
                    <div class=line><p>What is being reported:</p></div>
                    <div class=line><p>".$Rep_ID."</p></div>
            </div>
            <div class=two-items>
                    <div class=line><p>Detail:</p></div>
                    <div class=line><p>".$Detail."</p></div>
            </div>
            <div class=two-items>
                    <div class=line><p>Status:</p></div>
                    <div class=line><p>".$Status."</p></div>
            </div>
            <div class=line><a href=\"Reports_edit.php?RepOth_ID={$RepOth_ID1}\">Edit Report</a></div>
            ";
        }
    }
?>
  
  <?php 
    include_once(realpath(CONNECTION_PATH));
    if ($_REQUEST['RepSys_ID'])
    {
        $RepSys_ID1 = $_REQUEST['RepSys_ID'];
        $sql_find =  "SELECT * FROM report_system WHERE RepSys_ID = '$RepSys_ID1' ";                              
        $result = $conn->query($sql_find);
    
    if ($result->num_rows >0)
    {   while($row = $result->fetch_assoc())
        {   $ReporterEmail = $row['ReporterEmail'];
            $DropType = $row['DropType'];
            $Detail = $row['Detail'];
            $Status = $row['Status'];   
        }  
        echo "  
        <div class = two-items>
            <div class = line><p>Report Type:</p></div>
            <div class = line><p>Report System</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Report ID:</p></div>
                <div class=line><p>".$RepSys_ID1."</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Reporter Email:</p></div>
                <div class=line><p>".$ReporterEmail."</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Drop Type:</p></div>
                <div class=line><p>".$DropType."</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Detail:</p></div>
                <div class=line><p>".$Detail."</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Status:</p></div>
                <div class=line><p>".$Status."</p></div>
        </div>

        <div class=line><a href=\"Reports_edit.php?RepSys_ID={$RepSys_ID1}\">Edit Report</a></div>

    ";
    }
    
}?>  
</div>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>