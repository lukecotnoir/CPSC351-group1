<html>
<body>
<form action="request_community.php" method="post">


 New Community Request: <br><br>

 Enter Community Information:
 <br>

 Community Name: <input type="text" name="comm_name"><br>
 Community Affiliate Name: <input type="text" name="affiliate_name"> <br>
 Community Affiliate Email: <input type='text' name='affiliate_email'><br>
 <input type="submit" name="submit">
 </form>


 <?php
 if(isset($_POST['comm_name'], $_POST['affiliate_name'], $_POST['affiliate_email']))
 {
   $community_name = $_POST['comm_name'];
   $affiliate_name = $_POST['affiliate_name'];
   $affiliate_email = $_POST['affiliate_email'];

   # this connects to the local host
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "test_db";

   // Create connection
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }

   $sql = "INSERT INTO CommunityRequests (comm_name, aff_name, aff_email)
   VALUES ('$community_name', '$affiliate_name', '$affiliate_email')";

   if(mysqli_query($conn, $sql)){
     echo "<h4> Request Successfully Submitted";
   }

 }
 ?>
 </body>
 </html>