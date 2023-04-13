<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if(!isset($_SESSION['email'])) {
    header("location:/CPSC351-group1/index.php");
}
?>

<link href="../../public_html/css/report-page.css" rel="stylesheet">


<div class="report-form">
    <form action="Reports_edit_Other.php?RepOth_ID=<?php echo $_GET['RepOth_ID']?>" method="post">
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
    $sql_update = "UPDATE report_other SET Status = '".$status_new."' WHERE RepOth_ID = '".$_GET['RepOth_ID']."'";
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