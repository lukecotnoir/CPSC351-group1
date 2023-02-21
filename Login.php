<?php
include_once(realpath("resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href=public_html/css/login-styling.css rel="stylesheet">
<div class=login-form>
    <form action="Login.php" method="post">
        <div class="title"><p>Enter your login information here:</p></div>
        <div class="username">
            <p>Email:&nbsp</p> 
            <div class=text-box><input type="text" name="uname"></div>
        </div>
        <div class="password">
            <p>Password:&nbsp</p>
            <div class=text-box><input type="password" name="pword" id="password"></div>
        </div>
        <div class="show-password"><input type="checkbox" onclick="myFunction()"><p style="font-size: 12px;">Show Password</p></div>
        <script>
          function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
        </script>
        <div class=button><input type="submit" name="submit"></div>
        <div class="sign-up">
            <p>Don't have an account: <a href=Sign_up.php>Sign up!</a></p>
        </div>
    </form>
</div>
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
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>