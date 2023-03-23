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
    if ($_REQUEST['RepOth_ID'])
        $RepOth_ID = $_REQUEST['RepOth_ID'];
        $sql_find =  "SELECT * FROM report_other WHERE RepOth_ID = '$RepOth_ID' ";                              
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
            <div class = line><p>Report Other</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Report ID:</p></div>
                <div class=line><p>".$RepOth_ID."</p></div>
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
    ";
    }?>
  
  <?php 
    include_once(realpath(CONNECTION_PATH));
    if ($_REQUEST['RepOth_ID'])
        $RepOth_ID = $_REQUEST['RepOth_ID'];
        $sql_find =  "SELECT * FROM report_other WHERE RepOth_ID = '$RepOth_ID' ";                              
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
            <div class = line><p>Report Other</p></div>
        </div>
        <div class=two-items>
                <div class=line><p>Report ID:</p></div>
                <div class=line><p>".$RepOth_ID."</p></div>
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
    ";
    }?>  


    <div class=button style="padding: 5px"><input id="edit_button" type="button" value="Edit Report"></div>
    <script type="text/javascript">
    document.getElementById("edit_button").onclick = function () {
    location.href = "/CPSC351-group1/pages/reports/Reports_edit.php";
    };
    </script>
    
</div>

<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>