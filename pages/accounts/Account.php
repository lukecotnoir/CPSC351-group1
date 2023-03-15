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
    <div class=two-items>
        <div class=line><p>Email:</p></div>
        <div class=line><p><?php echo $_SESSION['email']?></p></div>
    </div>
    <?php if($_SESSION['startYr'] != 0)
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
    <?php if(isset($_SESSION['major']))
        echo "
        <div class=two-items>
            <div class=line><p>Major(s):</p></div>
            <div class=line><p>".$_SESSION['major']."</p></div>
        </div>
        ";
    ?>
</div>

<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>