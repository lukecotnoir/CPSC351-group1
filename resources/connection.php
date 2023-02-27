<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cpsc351_project";

    $conn = mysqli_connect($servername, $username, $password, $dbname)
        or die("bad connection: ".mysqli_connect_error())
?>