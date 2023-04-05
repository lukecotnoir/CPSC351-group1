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
  </form>
</div>


<?php
if(isset($_POST['comm_name'], $_POST['affiliate_name'], $_POST['reason']))
{
  $community_name = $_POST['comm_name'];
  $affiliate_name = $_POST['affiliate_name'];
  $reason = $_POST['reason'];

  # this connects to the local host
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cpsc351_project";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO Comm_Requests (CommName, PCSEAffiliate, Reason)
  VALUES ('$community_name', '$affiliate_name', '$reason')";

  if(mysqli_query($conn, $sql)){
    echo "<h4> Request Successfully Submitted";
  }

}
?>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"))
?>
