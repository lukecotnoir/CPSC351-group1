<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));
    $sql = "INSERT INTO Accounts_in_Comm (Accounts_CNUID, Community_idCommunity)
            VALUES (".$_SESSION['ID'].", ".$_GET['id'].")";
    $ver = mysqli_query($conn, $sql);
    $sql2 = "UPDATE Community SET MemberCount = MemberCount + 1 WHERE CommID = ".$_GET['id']."";
    $ver2 = mysqli_query($conn, $sql2);
    if(!$ver)
        die ("The error is: " . mysqli_error($conn));
    else
        header("location:/CPSC351-group1/pages/communities/Communities_view.php");
?>