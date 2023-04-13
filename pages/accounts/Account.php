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
        <p>Welcome,&nbsp;<?php echo $_SESSION['fName'];?> <?php echo $_SESSION['lName'];?></p>
    </div>
    <hr style="width: 75%">
    <div class=two-items>
        <div class=line><p>Email:</p></div>
        <div class=line><p><?php echo $_SESSION['email']?></p></div>
    </div>
    <?php if($_SESSION['startYr'])
        echo "
        <div class=two-items>
            <div class=line><p>Start Year:</p></div>
            <div class=line><p>".$_SESSION['startYr']."</p></div>
        </div>
        "; 
    ?>
    <div class=two-items>
        <div class=line><p>Grad Year:</p></div>
        <div class=line><p><?php echo $_SESSION['gradYr']?></p></div>
    </div>
    <?php if($_SESSION['major'])
        echo "
        <div class=two-items>
            <div class=line><p>Major(s):</p></div>
            <div class=line><p>".$_SESSION['major']."</p></div>
        </div>
        ";
    ?>
    <?php if($_SESSION['minor'])
        echo "
        <div class=two-items>
            <div class=line><p>Minor(s):</p></div>
            <div class=line><p>".$_SESSION['minor']."</p></div>
        </div>
        ";
    ?>
    <div class=two-items>
        <div class=line><p>Account Type:</p></div>
        <div class=line><p><?php echo $_SESSION['accType']?></p></div>
    </div>
    <?php if($_SESSION['accType'] == 'Alumni')
        echo "
        <div class=two-items>
            <div class=line><p>Employer:</p></div>
            <div class=line><p>".$_SESSION['empl']."</p></div>
        </div>
        <div class=two-items>
            <div class=line><p>Job Title:</p></div>
            <div class=line><p>".$_SESSION['jobTitle']."</p></div>
        </div>
        ";
    ?>
    <div class=button style="padding: 5px"><input id="edit_button" type="button" value="Edit Account Info"></div>
    <script type="text/javascript">
    document.getElementById("edit_button").onclick = function () {
    location.href = "/CPSC351-group1/pages/accounts/Edit_account.php";
    };
    </script>
    <div class=button style="padding: 5px"><input id="view_report_button" type="button" value="View My Reports"></div>
    <script type="text/javascript">
    document.getElementById("view_report_button").onclick = function () {
    location.href = "/CPSC351-group1/pages/reports/Reports_userview.php";
    };
    </script>
    <a href="/CPSC351-group1/pages/accounts/Logout.php" style="color: #b0453e;">Logout</a>
</div>

<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>