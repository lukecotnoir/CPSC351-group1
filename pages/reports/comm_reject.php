<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));
    $sql = "DELETE FROM Comm_Requests WHERE request_ID = ".$_GET['id']."";
    $ver = mysqli_query($conn, $sql);
    if(!$ver)
        die ("The error is: " . mysqli_error($conn));
    else
        header("location:/CPSC351-group1/pages/reports/Community_requests.php");
?>