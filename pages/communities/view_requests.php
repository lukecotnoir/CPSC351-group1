<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    $choice = $_POST['CommName'];
    $CommName = $_POST['PCSEAffiliate'];
    $Accounts_UserID = $_POST['Accounts_UserID'];
    $Reason = $_POST['Reason'];
?>

<link href="../../public_html/css/comm_request-styling.css" rel="stylesheet">
<div class="comm_request-form">
    <form action="view_requests.php" method="post">
        <div class='title'>
            <p>Please select an option</p>
        </div>
            <div class="line">
                <div class="two-items">
                    <div class='line'><input type="radio" id="view_comms" name="comm_type" value="ViewCommunities" onclick='newRequest()'></div>
                    <div class='line'><label for="view_comms">View Communities</label></div>
                </div>
                <div class="two-items">
                    <div class='line'><input type="radio" id="view_requests" name="comm_type" value="CommunityRequests" onclick='newRequest()'></div>
                    <div class='line'><label for="view_requests">Community Requests</label></div>
                </div>
                <div class="two-items">
                    <div class='line'><input type="radio" id="make_requests" name="comm_type" value="MakeRequest" onclick="newRequest()"></div>
                    <div class='line'><label for="make_requests">Make Request</label></div>
                </div>
            </div>
            <div id="textboxes" class="two-items" style="display: none">
                <div class="line">
                    <p>New Community Name:&nbsp</p>
                    <div class="text-box"><input type="text" name="CommName" value="<?php echo $CommName; ?>"></div>
                </div>
                <div class="line">
                    <p>PCSE Affiliate:&nbsp</p>
                    <div class="text-box"><input type="text" name="PCSEAffiliate" value="<?php echo $PCSEAffiliate; ?>"></div>
                </div>
                <div class="line">
                    <p>Your ID:&nbsp</p>
                    <div class="text-box"><input type="text" name="Accounts_UserID" value="<?php echo $Accounts_UserID; ?>"></div>
                </div>
                <div class="line">
                    <p>Reason:&nbsp</p>
                    <div class="text-box"><input type="text" name="Reason" value="<?php echo $Reason; ?>"></div>
                </div>
            </div>

            <script>
                function newRequest() {
                    var x = document.getElementById("make_requests");
                    if (x.checked) {
                        document.getElementById("textboxes").style.display = "flex";
                    } else {
                        document.getElementById("textboxes").style.display = "none";
                    }
                }
            </script>

            <div class="button">
                <input type="submit" name="submit">
            </div>
    </form>
</div>

<?php
include_once(realpath(CONNECTION_PATH));
include_once(realpath(TEMPLATES_PATH . "/header.php"));

$want = $_POST['comm_type'];

if ($want == 'CommunityRequests') {
    $sql = "SELECT * FROM comm_requests";
    $result = $conn->query($sql);


    if (mysqli_num_rows($result) > 0) {
        echo 'request_ID||CommName||PCSEAffiliate||Account_UserID||Reason<br>';
        while ($row = $result->fetch_assoc()) {
            echo $row['request_ID'];
            echo "||";
            echo $row['CommName'];
            echo "||";
            echo $row['PCSEAffiliate'];
            echo "||";
            echo $row['Accounts_UserID'];
            echo '||';
            echo $row['Reason'];
        }
    }
}

if ($want == 'MakeRequest') {
    if (isset($_POST['comm_name'], $_POST['affiliate_name'], $_POST['affiliate_email'])) {
        $CommName = $_POST['CommName'];
        $PCSEAffiliate = $_POST['PCSEAffiliate'];
        $Accounts_UserID = $_POST['Accounts_UserID'];
        $Reason = $_POST['Reason'];

        $sql = "INSERT INTO comm_requests(CommName, PCSEAffiliate, Accounts_UserID, Reason)
     VALUES ('$CommName', '$PCSEAffiliate', '$Accounts_UserID', '$Reason')";

        if (mysqli_query($conn, $sql)) {
            echo "<h4> Request Successfully Submitted";
        }
    }
}
?>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>