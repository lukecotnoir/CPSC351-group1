<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
      header("location:/CPSC351-group1/index.php");
    }
?>
<link href="../../public_html/css/search_page-styling.css" rel="stylesheet">
<?php
include_once(realpath(CONNECTION_PATH));
$sql = "SELECT * FROM comm_requests";
$result = $conn->query($sql);
if (($result->num_rows >0)) {
  echo "<div class='results_table'>
  <div class='title'><p style='text-decoration: underline;'>Community Requests</p></div>
  <table border='1'>
  <tr>
      <th>Name</th>
      <th>Affiliate</th>
      <th>Reason</th>
      <th>Allow</th>
      <th>Reject</th>
  </tr>
  ";
  $a = array();
  while($row = $result->fetch_assoc()) {
      if(!in_array($row, $a)) {
          $a[] = $row;
      }
  }
  foreach($a as $row)
  {   echo "<tr>
              <td>{$row['CommName']}</td>
              <td>{$row['PCSEAffiliate']}</td>
              <td>{$row['Reason']}</td>
              <td><a href='comm_allow.php?id=".$row['request_ID']."'>Allow</a></td>
              <td><a href='comm_reject.php?id=".$row['request_ID']."'>Reject</a></td>
      </tr>";
  }
  echo "</table></div>";
}
else {
  echo "<br>There are no results for your search";
}
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
