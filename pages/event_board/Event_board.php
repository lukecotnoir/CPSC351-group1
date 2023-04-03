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
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
      }
      h1 {
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
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      input[type=submit]:hover {
        background-color: #45a049;
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $event = $_POST['event'];

    // Connect to MySQL database
    $host = 'localhost';
    $username = 'your_username_here';
    $password = 'your_password_here';
    $database = 'your_database_name_here';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert form data into MySQL database
    $sql = "INSERT INTO signups (name, email, date, event) VALUES ('$name', '$email', '$date', '$event')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for signing up for $event on $date, $name!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Display form
    echo '<form method="POST">';
    echo '<label for="name">Name:</label>';
    echo '<input type="text" name="name" required>';
    echo '<br>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" name="email" required>';
    echo '<br>';
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