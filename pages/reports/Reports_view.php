<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="../../public_html/css/account.css" rel="stylesheet">
<div class=account_info>
    <div class=title>
        <p>Welcome,&nbsp;<?php echo $_SESSION['fName'];?> <?php echo $_SESSION['lName'];?></p>
    </div>
    <hr style="width: 75%">

    <?php if ($_SESSION['RepOth_ID'])
    echo "<div class=two-items>
            <div class=line><p>Report ID:</p></div>
            <div class=line><p>".$_SESSION['RepOth_ID']."</p></div>
        </div>";?>
    
    <?php if ($_SESSION['RepSys_ID'])
    echo "<div class=two-items>
            <div class=line><p>Report ID:</p></div>
            <div class=line><p>".$_SESSION['RepSys_ID']."</p></div>
        </div>";?>

    <div class=two-items>
        <div class=line><p>Email:</p></div>
        <div class=line><p><?php echo $_SESSION['ReporterEmail']?></p></div>
    </div>
    <div class=two-items>
        <div class=line><p>Drop Type:</p></div>
        <div class=line><p><?php echo $_SESSION['DropType']?></p></div>
    </div>

    <?php if ($_SESSION['Rep_Acc_ID'])
    echo "<div class=two-items>
            <div class=line><p>Rep_Acc_ID:</p></div>
            <div class=line><p>".$_SESSION['Rep_Acc_ID']."</p></div>
        </div>";?>

    <?php if ($_SESSION['Rep_Comm_ID'])
    echo "<div class=two-items>
            <div class=line><p>Rep_Comm_ID:</p></div>
            <div class=line><p>".$_SESSION['Rep_Comm_ID']."</p></div>
        </div>";?>

    <?php if ($_SESSION['Rep_Mess_ID'])
    echo "<div class=two-items>
            <div class=line><p>Rep_Mess_ID:</p></div>
            <div class=line><p>".$_SESSION['Rep_Mess_ID']."</p></div>
        </div>";?>
    
    <?php if ($_SESSION['Rep_Post_ID'])
    echo "<div class=two-items>
            <div class=line><p>Rep_Post_ID:</p></div>
            <div class=line><p>".$_SESSION['Rep_Post_ID']."</p></div>
        </div>";?>

    <?php if ($_SESSION['Reason'])
    echo "<div class=two-items>
            <div class=line><p>Reason:</p></div>
            <div class=line><p>".$_SESSION['Reason']."</p></div>
        </div>";?>

    <div class=two-items>
        <div class=line><p>Status:</p></div>
        <div class=line><p><?php echo $_SESSION['Status']?></p></div>
    </div>

    
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