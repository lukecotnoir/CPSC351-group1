<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));

    $sql = "SELECT * FROM community";
    $result = $conn->query($sql);

    if (!$result) 
        die ("The error is: " . mysqli_error($conn));
    else {
        

    }

?>