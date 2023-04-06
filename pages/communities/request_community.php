<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
        header("location:/CPSC351-group1/index.php");
    }
?>
<link href=/CPSC351-GROUP1/public_html/css/sign_up-styling.css rel="stylesheet">
<div class='login-form'>
  <form action="request_community.php" method="post">
    <div class='title'><p>New Community Request: </p></div>
    <hr style="width: 75%">
    <div class='line'>
      <p>Community Name:</p>
      <div class='text-box'><input type="text" name="comm_name"></div>
    </div>
    <div class='line'>
      <p>Community Affiliate Name:</p>
      <div class='text-box'><input type="text" name="affiliate_name"></div>
    </div>
    <div class='line'>
      <p>Reason for Request:</p>
      <div class='text-box'><input type='text' name='reason'></div>
    </div>
    <div class=button><input type="submit" name="submit"></div>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  include_once(realpath(CONNECTION_PATH));
  $community_name = $_POST['comm_name'];
  $affiliate_name = $_POST['affiliate_name'];
  $reason = $_POST['reason'];

  $sql = "INSERT INTO Comm_Requests (CommName, PCSEAffiliate, Accounts_UserID, Reason)
  VALUES ('".$community_name."', '".$affiliate_name."', ".$_SESSION['ID'].", '".$reason."')";

  if(mysqli_query($conn, $sql)){
    echo "<div class='line'><p>Request successfully submitted</p></div>";
  }
  else {
    echo "<div class='line'><p>Error. Please try again.</p></div>";
    
  }

}
?>
</form>
</div>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"))
?>
