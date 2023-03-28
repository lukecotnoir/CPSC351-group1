<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
    include_once(realpath(CONNECTION_PATH));
    $sql = "SELECT CommName, PCSEAffiliate, YearCreated, MemberCount, PostCount 
            FROM Accounts, Accounts_in_Comm, Community
            WHERE Accounts.UserID = ". $_SESSION['ID'] ."
            AND Accounts.UserID = Accounts_in_Comm.Accounts_CNUID
            AND Community.CommID = Accounts_in_Comm.Community_idCommunity";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<p> '".$row['CommName']."', '".$row['PCSEAffiliate']."', '".$row['YearCreated']."'</p>";
    }

    include_once(realpath(TEMPLATES_PATH . "/footer.php"))
?>