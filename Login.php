<?php
include_once(realpath("resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<form action="file.php" method="post">
    Enter Log In Information <br>
    Username: 
    <div class=text-box><input type="text" name="uname"></div>
    <br> Password: 
    <div class=text-box><input type="text" name="pword"></div>
    <div class=button><input type="submit" name="submit"></div>
</form>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
<?php
if(isset($_POST['uname'], $_POST['pword']))
{
  $user = $_POST['uname'];
  $pass = $_POST['pword'];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_db";
    //database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname)
      or die("bad connection: ".mysqli_connect_error());


    //db set up string and run HttpQueryString
    $sql = "SELECT * FROM users where Username = '".$user."'
      and Password = '".$pass."'";
    $result = $conn->query($sql);

    //db execute query
    if ($result->num_rows > 0) {
    // output data of each row
  /*  while($row = $result->fetch_assoc()) {
      echo "<p>password for ".$row['Username']." is: " . $row["Password"]. "<br>";
      }
    } else {
      echo "0 results";*/
        echo "<p>You got in to the system";
      }
      else {
        echo "<p>You are rejected";
      }

    $conn->close();


}
?>