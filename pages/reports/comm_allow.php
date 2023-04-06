<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));
    $sql = "SELECT * FROM Comm_Requests WHERE request_ID = ".$_GET['id']."";
    $ver = mysqli_query($conn, $sql);
    $row = $ver->fetch_assoc();
    $sql2 = "INSERT INTO Community (CommName, PCSEAffiliate, YearCreated, MemberCount, PostCount) 
            VALUES ('".$row['CommName']."', '".$row['PCSEAffiliate']."', 2023, 0, 0)";
    $ver2 = mysqli_query($conn, $sql2);
    $sql3 = "DELETE FROM Comm_Requests WHERE request_ID = ".$_GET['id']."";
    $ver3 = mysqli_query($conn, $sql3);
    if(!$ver)
        die ("The error is: " . mysqli_error($conn));
    else
        header("location:/CPSC351-group1/pages/reports/Community_requests.php");
?>