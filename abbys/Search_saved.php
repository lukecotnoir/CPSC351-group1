<html><body>
<form action="searching.php" method="post">
What are you searching for?:
    <select name = "dropdown">
        <option value = "" selected> </option>
        <option value = "Account" selected>Account</option>
        <option value = "Community">Community</option>
    </select>  </p>
<input type="text" name="searched">
<input type="submit" name="submit">
</form><body></html>
<?php

$servername = "localhost";
$username  = "root";
$password = "";
$dbname = "project_testing";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$searched = $_POST['searched'];
$choice = "Community";        #Set as account now

if ($choice =="Accounts"&& isset($searched) )
{
    echo "You searched $searched in $choice";

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
    echo "You searched $searched in $choice";

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
        echo $row['CommID'];echo "||";echo $row['Name'];echo "||";echo $row['PCSEAffiliate'];
        echo "||";echo $row['YearCreated'];echo'||';echo $row['MemberCount'];echo'||';
        echo $row['PostCount'];

    }
        
    }
	else {
		echo "Error: ";
	}
}

?>