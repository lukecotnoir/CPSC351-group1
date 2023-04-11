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
<link href="../../public_html/css/community.css" rel="stylesheet">
<div class='title'>
    <p style='font-size: 32px'>
        <?php if (isset($commName)) echo $commName;?>
    </p>
    <a href='comm_info.php?id=<?php echo $commID;?>'>Info</a>
</div>
<hr style='width: 75%'>
<div class='create-post'>
    <form action="view_comm.php?id=<?php echo $commID?>" method="post">
        <div class='line'>
            Create a post:&nbsp;
            <textarea id='post' name='create_post' rows="4" cols="50"></textarea>
            <div class=button><input type="submit" name="submit" value="Submit Post"></div>
        </div>
    </form>
</div>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once(realpath(CONNECTION_PATH));
        $current_time = date('Y-m-d H:i:s');
        $insert_post = "INSERT INTO Post (UserID, PostTime, PostText, CommID) 
                        VALUES ('".$_SESSION['ID']."', '".$current_time."', '".$_POST['create_post']."', '".$commID."')";
        $insert_query = mysqli_query($conn, $insert_post);
        if ($insert_query) echo "<script>location.href = '/CPSC351-group1/pages/communities/view_comm.php?id=".$commID.";</script>";
    }
?>
<?php
    $select_posts = "SELECT * FROM Post WHERE CommID = '".$commID."' ORDER BY PostTime DESC";
    $posts = $conn->query($select_posts);
    if($posts->num_rows > 0) {
        echo "<div class='post_list'>";
        while($row = $posts->fetch_assoc()) {
            $find_user = "SELECT * FROM Accounts WHERE UserID = ".$row['UserID']."";
            $user = $conn->query($find_user);
            while($row_user = $user->fetch_assoc()) {
                $email = $row_user['Email'];
                $firstName = $row_user['FirstName'];
                $lastName = $row_user['LastName'];
                $fullName = $firstName.' '.$lastName;
            }
            echo "    
            <div class='post'>
                <div class='name'>
                    ".$fullName."
                </div>
                <div class='text'>
                    ".$row ['PostText']."
                </div>
                <div class='time'>
                    Posted: ".$row['PostTime']."
                </div>
            </div>";
        }
        echo "</div>";
    }

?>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"))
?>