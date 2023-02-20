<?php
include_once(realpath("resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href=public_html/css/login-styling.css rel="stylesheet">
<div class=login-form>
    <form action="file.php" method="post">
        <p>Enter your login information here:</p>
        <div class="username">
            <p>Username:&nbsp</p> 
            <div class=text-box><input type="text" name="uname"></div>
        </div>
        <div class="password">
            <p>Password:&nbsp</p>
            <div class=text-box><input type="text" name="pword"></div>
        </div>
        <div class=button><input type="submit" name="submit"></div>
        <div class="sign-up">
            <p>Don't have an account: <a href=Login.php>Sign up!</a></p>
        </div>
    </form>
</div>
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