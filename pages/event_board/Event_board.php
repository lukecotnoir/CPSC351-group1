<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    if(!isset($_SESSION['email'])) {
      header("location:/CPSC351-group1/index.php");
  }
?>
<link href="../../public_html/css/event-board.css" rel="stylesheet">
<div class='container'>
  <div class='event-select'>
    <h2>Select a month to view events</h2>
    <form action="Event_board.php" method="POST">
      <select name='month' id='month'>
        <option value='01'>January</option>
        <option value='02'>February</option>
        <option value='03'>March</option>
        <option value='04'>April</option>
        <option value='05'>May</option>
        <option value='06'>June</option>
        <option value='07'>July</option>
        <option value='08'>August</option>
        <option value='09'>September</option>
        <option value='10'>October</option>
        <option value='11'>November</option>
        <option value='12'>December</option>
      </select>
      <input type="submit" name = "submit" value="Select">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST["submit"] == 'Select') {
    include_once(realpath(CONNECTION_PATH));
    $month = $_POST['month'];
    $event_select = "SELECT * FROM Events WHERE MONTH(EventDate) = ".(int) $month."";
    $results = $conn->query($event_select);
    if ($results->num_rows > 0) {
      echo "<div class='results_table'>";
      echo "<table border='1'>
      <tr><th>Event Name</th><th>Date</th></tr>";
      while($row = $results->fetch_assoc()) {
        echo "<tr><td>";
        echo $row['EventLocation'];
        echo "</td><td>";
        echo $row['EventDate'];
        echo "</td></tr>";
      }
      echo "</table></div>";
    }
    else {
      echo "<p style='color: black'>It looks like there are no events in that month!</p>";
    }
  }
}
?>
  </form>
  </div>
  <div class='sign-up-form'>
    <h2>Event Sign-Up Form</h2>
    <form action="Event_board.php" method="POST">
      <label for="date">Date:</label>
      <input type="date" name="date" required>
      <label for="event">Event:</label>
      <input type="text" name="event">
      <br>
      <input type="submit" name="submit" value="Sign Up">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if($_POST['submit'] == 'Sign Up'){
    // Handle form submission
    $email = $_SESSION['email'];
    $date = $_POST['date'];
    $event = $_POST['event'];
    // Connect to MySQL database
    include_once(realpath(CONNECTION_PATH));

    // Insert form data into MySQL database
    $sql1 = "SELECT idEvents FROM Events WHERE EventDate = '".$date ."' AND EventLocation = '".$event."'";
    $result = $conn->query($sql1);
    if ($result->num_rows == 0) {
      echo "<p> That event was not found. Make sure the entered information is correct.</p>";
    }
    else {
      $row = $result->fetch_assoc();
      $eventid = $row['idEvents'];
      $sql2 = "SELECT * FROM Accounts_Attending WHERE Events_idEvents = ".$eventid." AND Accounts_CNUID = ".$_SESSION['ID']."";
      $ver = mysqli_query($conn, $sql2);
      if ($ver->num_rows > 0) {
        echo"<p>It looks like you've already signed up for $event on $date.</p>";
      }
      else {
        $insert_sql = "INSERT INTO Accounts_Attending (Events_idEvents, Accounts_CNUID) VALUES (".$eventid.", ".$_SESSION['ID'].")";
        $verify = mysqli_query($conn, $insert_sql);
        if ($verify) echo "<p>Thanks for signing up!</p>";
        else echo "<p>Error</p>";
      }
    }

  } 
}
?>
  </form>
  </div>
</div>
</body>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
