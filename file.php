<html><body>

  Welcome to PCSU Student-Alum Connection!



<form action="file.php" method="post">
<!-- Admin: <input type="radio" name="admin">
<br> Alumni: <input type="radio" name="alum">
<br> Student: <input type="radio" name="student">
<p>

-->
Enter Log In Information


<br>

Username: <input type="text" name="uname">
<br> Password: <input type="text" name="pword"> <p>
<input type="submit" name="submit">
</form>

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
</body></html>
