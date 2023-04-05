<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
      header("location:/CPSC351-group1/index.php");
    }
?>

<link href="../../public_html/css/comm_request-styling.css" rel="stylesheet">
<?php
include_once(realpath(CONNECTION_PATH));
echo "This is were admin views community requests.";
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

include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
