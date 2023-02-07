<html><body>
<form action="searching.php" method="post">
What are you searching for?: <p>
<input type="text" name="searched">
<input type="submit" name="submit">
</form><body></html>
<?php
/*<select name = "dropdown">
<option value = "Account" selected>Account</option>
<option value = "Community">Community</option>
</select>  
SQL set up
$servername = "localhost";
$username  = "root";
$password = "";
$dbname = "project_testing";
$conn = mysqli_connect($servername, $username, $password, $dbname);*/

$servername = "localhost";
$username  = "root";
$password = "";
$dbname = "project_testing";
$conn = mysqli_connect($servername, $username, $password, $dbname);


$searched = $_POST['searched'];
$choice = "Account";        #Set as account now
if ($choice =="Account"&& isset($searched) )
{
    echo "You searched $searched and $choice";

    $sql_find =  "SELECT * FROM accounts WHERE FirstName = '$searched'";#OR
                                               /*FirstName LIKE '%$search%' OR
                                               LastName LIKE '%$search%' OR
                                               StartYear LIKE '%$search%' OR
                                               GraduationYear LIKE '%$search%' OR
                                               Email LIKE '%$search%' OR
                                               Acctype LIKE '%$search%' OR
                                               Major LIKE '%$search%' OR
                                               Minor(s) LIKE '%$search%' OR
                                               Employer LIKE '%$search%' OR
                                               JobTitle LIKE '%$search%'*/
                                               
    $result = $conn->query($sql_find);
    if ($result->num_rows >0){
    echo "<br>Here are the results of your search:<br>";
    while($row = $result->fetch_assoc()){
        echo $row['CNUID'];echo "||";echo $row['FirstName'];echo "||";echo $row['LastName'];
        echo "||";echo $row['StartYear'];echo'||';echo $row['GraduationYear'];echo'||';
        echo $row['Email'];echo'||'; echo $row['Acctype'];echo"||"; echo $row['Major'];
        echo "||";echo $row['Minor(s)']; echo '||';echo $row['Employer'];echo'||';echo $row['JobTitle'];
        echo '<br> <br>';

    }
        
    }
	else {
		echo "Error: ";
	}
}
if ($choice == "Community")
{

}

?>