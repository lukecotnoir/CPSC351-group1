<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    $choice = $_POST['comm_type'];
    $CommName = $_POST['PCSEAffiliate'];
    $Reason = $_POST['Reason'];
    if(!isset($_SESSION['email'])) {
      header("location:/CPSC351-group1/index.php");
    }
?>

<link href="../../public_html/css/comm_request-styling.css" rel="stylesheet">
<div class="comm_request-form">
  <form action="Communities.php" method="post">
    <div class= 'title'><p>Please select an option</p></div>
    <hr style="width: 75%;">
    <div class="line">
      <label for="view_comms">View Communities</label>
        <input type="radio" id="view_comms" name="comm_type" value="ViewCommunities" onclick = 'newRequest()' checked='checked'>
      </div>
      <div class="line">
        <label for="view_requests">Community Requests</label>
        <input type="radio" id="view_requests" name="comm_type" value="CommunityRequests" onclick = 'newRequest()'>
      </div>
      <div class="line">
        <label for="make_requests">Make Request</label>
        <input type="radio" id="make_requests" name="comm_type" value="MakeRequest" onclick="newRequest()">
      </div>

    <div class='stuff' style="display: none" id="stuff">
      <div class="line">
        <p>New Community Name:&nbsp</p>
        <div class="text-box"><input type="text" name="CommName" value="<?php echo $CommName; ?>"></div>
      </div>
      <div class="line">
        <p>PCSE Affiliate:&nbsp</p>
        <div class="text-box"><input type="text" name="PCSEAffiliate" value="<?php echo $PCSEAffiliate; ?>"></div>
      </div>
      <div class="line">
        <label for='reportdescribe'>Reason:</label>
        <textarea id='request_describe' name='request_describe' rows="3" cols="30">Enter details here.</textarea>
      </div>
    </div>
    <br>
    <script>
      function newRequest() {
        var x = document.getElementById("make_requests");
          if (x.checked) {
            document.getElementById("stuff").style.display="flex";
          } else {
            document.getElementById("stuff").style.display="none";
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

$want = $_POST['comm_type'];

if ($choice =='CommunityRequests')
{
  echo $choice;
  $sql = "SELECT * FROM comm_requests";
  $result = $conn->query($sql);


  if (mysqli_num_rows($result) > 0) 
  {
    echo 'request_ID||CommName||PCSEAffiliate||Account_UserID||Reason<br>';
    while($row = $result->fetch_assoc())
    {
      echo $row['request_ID'];echo "||";echo $row['CommName'];echo "||";echo $row['PCSEAffiliate'];
      echo "||";echo $row['Accounts_UserID'];echo'||';echo $row['Reason'];
    }
  }
}

if ($choice =='MakeRequest')
{
  #echo $choice;
  
    $CommName = $_POST['CommName'];
    $PCSEAffiliate = $_POST['PCSEAffiliate'];
    $Accounts_UserID= $_POST['Accounts_UserID'];
    $Reason = $_POST['Reason'];

    #echo $CommName;echo "||";echo $PCSEAffiliate;echo"||";echo $Accounts_UserID;echo "||";echo $Reason;
  
    $sql = "INSERT INTO comm_requests(CommName, PCSEAffiliate, Accounts_UserID, Reason)
    VALUES ('$CommName', '$PCSEAffiliate', '$Accounts_UserID', '$Reason')";
  
    if(mysqli_query($conn, $sql)){
      echo "<h4> Request Successfully Submitted";
    }
  
  
}


include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
