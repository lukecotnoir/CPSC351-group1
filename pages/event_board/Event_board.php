<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Event Sign Up Form</title>
    <style>
      p {
        color: var(--text-primary);
      }
      body {
        font-family: var(--global-font);
        background-color: var(--bg-dark);
      }
      h1 {
        color: var(--text-primary);
        text-align: center;
        margin-top: 50px;
      }
      form {
        max-width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      }
      label {
        display: block;
        margin-bottom: 10px;
      }
      input[type=text], select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 20px;
      }
      input[type=submit] {
        background-color: var(--bg-blue-secondary);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      input[type=submit]:hover {
        background-color: #FFD700;
      }
      .error {
        color: red;
      }
    </style>
  </head>
  <body>
	<h1>Event Sign-Up Form</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $email = $_SESSION['email'];
    $date = $_POST['date'];
    $event = $_POST['event'];
    // Connect to MySQL database

    include_once(realpath(CONNECTION_PATH));

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert form data into MySQL database
    $sql1 = "SELECT idEvents FROM Events WHERE EventDate = '".$date ."' AND EventLocation = '".$event."'";
    $result = $conn->query($sql1);
    if ($result->num_rows == 0) {
      echo "<p> That event was not found. Make sure the entered information is correct.</p>";
    }
    else {
      $row = $result->fetch_assoc();
      $eventid = $row['idEvents'];
      $sql2 = "INSERT INTO Accounts_Attending (Events_idEvents, Accounts_CNUID) VALUES (".$eventid.", ".$_SESSION['ID'].")";
      echo 'test';
      echo $sql2;
      $ver = $conn->query($sql2);
      if ($ver) {
        echo "<p>Thank you for signing up for $event on $date!</p>";
      } 
      else {
        echo"<p>It looks like you've already signed up for $event on $date.</p>";
      }
    }

    $conn->close();
} else {
    // Display form
    echo '<form method="POST">';
    echo '<label for="date">Date:</label>';
    echo '<input type="date" name="date" required>';
    echo '<br>';
    echo '<label for="event">Event:</label>';
    echo '<input type="text" name="event" required>';
    echo '<br>';
    echo '<input type="submit" value="Sign Up">';
    echo '</form>';
}
?>
</body>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
</html>