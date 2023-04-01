<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));
    $sql = "DELETE FROM Accounts_in_Comm 
            WHERE Accounts_CNUID = ".$_SESSION['ID']." AND Community_idCommunity = ".$_GET['id']."";
    $ver = mysqli_query($conn, $sql);
    if(!$ver)
        die ("The error is: " . mysqli_error($conn));
    else
        header("location:/CPSC351-group1/pages/communities/Communities_view.php");
?>