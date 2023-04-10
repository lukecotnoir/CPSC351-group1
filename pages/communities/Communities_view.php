<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
?>
<link href="../../public_html/css/community_view.css" rel="stylesheet">
<?php
    include_once(realpath(CONNECTION_PATH));
    $sql = "SELECT CommID, CommName, PCSEAffiliate, YearCreated, MemberCount, PostCount 
            FROM Accounts, Accounts_in_Comm, Community
            WHERE Accounts.UserID = ". $_SESSION['ID'] ."
            AND Accounts.UserID = Accounts_in_Comm.Accounts_CNUID
            AND Community.CommID = Accounts_in_Comm.Community_idCommunity";
    $result = $conn->query($sql);
    $a = array();
    if($result->num_rows > 0) {
        echo "<div class='title'><p>Your Communities</p></div>
                <hr>
                <div class='comm-list'>";
        while($row = $result->fetch_assoc()) {
            $a[] = $row['CommID'];
            echo "    
            <div class='comm'>
                <div class='name'>
                    ".$row['CommName']."
                </div>
                <div class='item'>
                    Created ".$row['YearCreated']."
                </div>
                <div class='item'>
                    <a href=view_comm.php?id=".$row['CommID'].">View</a>
                </div>
                <div class='item'>
                    <a href=leave_comm.php?id=".$row['CommID']." style='color: #873737;' onclick='return myFunction();'>Leave</a>
                </div>
            </div>";
        }
    }     
?>
<script>
    function myFunction() {
        return confirm("Are you sure you want to leave?");
    }
</script>
</div>
<?php
    if ($a) {
        $sql2 = "SELECT * FROM Community WHERE CommID NOT IN (" . implode(',', $a) . ")";
        $result2 = $conn->query($sql2);
    }
    if ($result2->num_rows > 0) {
        echo "<div class='title'><p>Join Communities</p></div>
                <hr>
                <div class='comm-list'>";
        while($row = $result2->fetch_assoc()){
            echo "
            <div class='comm'>
                <div class='name'>
                    ".$row['CommName']."
                </div>
                <div class='item'>
                    Created ".$row['YearCreated']."
                </div>
                <div class='item'>
                    <a href=comm_info.php?id=".$row['CommID'].">Info</a>
                </div>
                <div class='item'>
                    <a href=join.php?id=".$row['CommID']." style='color: #2c692c;' onclick='return myFunction2();'>Join</a>
                </div>
            </div>";
        }
    }
    else {
        if ($a) {
            $sql3 = "SELECT * FROM Community WHERE CommID NOT IN (" . implode(',', $a) . ")";
        }
        else
            $sql3 = "SELECT * FROM Community";
            $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
        echo "<div class='title'><p>Join Communities</p></div>
                <hr>
                <div class='comm-list'>";
            while($row = $result3->fetch_assoc()){
                echo "
                <div class='comm'>
                    <div class='name'>
                        ".$row['CommName']."
                    </div>
                    <div class='item'>
                        Created ".$row['YearCreated']."
                    </div>
                    <div class='item'>
                        <a href=view_comm.php?id=".$row['CommID'].">View</a>
                    </div>
                    <div class='item'>
                        <a href=join.php?id=".$row['CommID']." style='color: #2c692c;' onclick='return myFunction2();'>Join</a>
                    </div>
                </div>";
            }
        }
    }
?>
</div>
<script>
    function myFunction2() {
        return confirm("Are you sure you want to join?");
    }
</script>
<div class='request'><a href="request_community.php">Request New Community</a></div>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"))
?>