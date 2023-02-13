<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
</head>
<body>
<form action="Search_saved.php" method="post">
What are you searching for?:
    <select name = "dropdown">
        <option value = " " selected> </option>
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
$choice = $_POST['dropdown'];        #Set as account now

if ($choice =="Account"&& isset($searched) )
{
    echo "You searched $searched in $choice";

    $sql_find =  "SELECT * FROM accounts WHERE (FirstName = '$searched') OR
                                                (LastName = '$searched') OR
                                                (StartYear = '$searched') OR
                                                (GraduationYear = '$searched') OR
                                                (Email = '$searched') OR
                                                (Acctype = '$searched') OR
                                                (Major = '$searched') OR
                                                (Minor(s) = '$searched') OR
                                                (Employer = '$searched') OR
                                                (JobTitle = '$searched')";
                                            
                                               
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
else
{
    echo "Press submit to search";
}

if ($choice == "Community")
{
    echo "You searched $searched in $choice";

    $sql_find =  "SELECT * FROM accounts WHERE (ConnID = '$searched') OR
                                                (CommName = '$searched') OR
                                                (PCSEAffiliate = '$searched') OR
                                                (YearCreated = '$searched') OR
                                                (MemberCount= '$searched') OR
                                                (PostCount = '$searched')";
                                            
                                               
    $result = $conn->query($sql_find);
    if ($result->num_rows >0){
    echo "<br>Here are the results of your search:<br>";
    while($row = $result->fetch_assoc()){
        echo $row['CommID'];echo "||";echo $row['CommName'];echo "||";echo $row['PCSEAffiliate'];
        echo "||";echo $row['YearCreated'];echo'||';echo $row['MemberCount'];echo'||';
        echo $row['PostCount'];

    }
        
    }
	else {
		echo "Error: ";
	}
}
else
{
    echo "Press submit to search";
}

?>