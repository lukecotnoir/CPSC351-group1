<html><body>


Welcome to PCSU Student-Alum Connection!



<form action="create_post.php" method="post">


Create New Post: <br><br>

Community: <input type="text" name="community"><br>
Text: <input type="textarea" name="main"> <br>
<input type="submit" name="submit">
</form>


<?php
if(isset($_POST['community'], $_POST['main']))
{

  $PostID = 1;
  $PostTime = date("Y.m.d") . date("h:i:s");
  $PostText = $_POST['main'];
  $CommID = $_POST['community'];

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


  $sql = "INSERT INTO Post (PostID, UserID, PostTime, PostText, CommID)
  VALUES ('".$PostID"', '.$_SESSION['ID'].', '".$PostTime"', '".$PostText"', '".$CommID"')";

  if(mysqli_query($conn, $sql)){
    echo "<h4> You Successfully Posted";
    $PostID++;
  }

}

?>
</body></html>
