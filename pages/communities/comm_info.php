<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    include_once(realpath(CONNECTION_PATH));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    $commID = $_GET['id'];
    $sql = "SELECT * FROM Community WHERE CommID = ".$commID."";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $commName = $row['CommName'];
        $affiliate = $row['PCSEAffiliate'];
        $yearCreated = $row['YearCreated'];
        $MemberCount = $row['MemberCount'];
    }
?>
<link href="../../public_html/css/account.css" rel="stylesheet">
<div class=account_info>
    <div class=title>
        <p><?php echo $commName?></p>
    </div>
    <hr style="width: 75%">
    <div class='two-items'>
        <div class='line'><p>PCSE Affiliate:</p></div>
        <div class='line'><p><?php echo $affiliate?></p></div>
    </div>
    <div class='two-items'>
        <div class='line'><p>Year Created:</p></div>
        <div class='line'><p><?php echo $yearCreated?></p></div>
    </div>
    <div class='two-items'>
        <div class='line'><p>Member Count:</p></div>
        <div class='line'><p><?php echo $MemberCount?></p></div>
    </div>
<?php
    include_once(realpath(CONNECTION_PATH));
    $sql = "SELECT FirstName, LastName, Email FROM Community, Accounts_in_Comm, Accounts 
            WHERE Community.CommID = ".$commID." 
            AND Community.CommID = Accounts_in_Comm.Community_idCommunity 
            AND Accounts_in_Comm.Accounts_CNUID = Accounts.UserID";
    $result = mysqli_query($conn, $sql);
    echo "
    <div class='line'><p>Members</p></div>
    <hr style='width: 75%'>
    ";
    while($row = $result->fetch_assoc()) {
        echo "
        <div class='two-items'>
            <div class='line'><p>".$row['FirstName']." ".$row['LastName']."</p></div>
            <div class='line'><p>".$row['Email']."</p></div>
        </div>
        ";
    }
?>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>