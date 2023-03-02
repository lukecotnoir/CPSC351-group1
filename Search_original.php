<?php
    include_once(realpath("resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
    $email = $_POST['email'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $startYr = $_POST['startYr'];
    $gradYr = $_POST['gradYr'];
    $major = $_POST['major'];
    $minor = $_POST['minor'];
    $acctype = $_POST['acctype'];
    $empl = $_POST['empl'];
    $job = $_POST['job'];
    $pword = $_POST['pword'];
    $confirm_pword = $_POST['confirm_pword'];
?>
<link href="public_html/css/search-page-styling.css" rel="stylesheet">
<div class="search-form">
    <form action="Search_original.php" method="post">
    <div class="line">
         
        

        <div class="type-search">
            <p>What are you searching for?:</p>
            <select name="dropdown">
                <option value = "Account" selected>Account</option>
                <option value = "Community">Community</option>
            </select>
        </div>

        
        <div class="search-input">
            <div class="text-box">
                <input type="text" name="searched">
            </div>
            <div class="button">
                <input type="submit" name="submit">
            </div>
        </div>
    </form>
</div>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>
<?php
include_once(realpath("resources/connection.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));

$searched = $_POST['searched'];
$choice = $_POST['dropdown']; 

if ($choice =="Account" )
{
    echo "You searched $searched in $choice";

    $sql_find =  "SELECT * FROM accounts WHERE FirstName LIKE '$searched%' OR
                                                LastName LIKE '$searched%' OR
                                                StartYear LIKE '$searched%' OR
                                                GraduationYear LIKE '$searched%' OR
                                                Email LIKE '$searched%' OR
                                                Acctype LIKE '$searched%' OR
                                                Major LIKE '$searched%' OR
                                                Minor LIKE '$searched%' OR
                                                Employer LIKE '$searched%' OR
                                                JobTitle LIKE '$searched%'";
                                                
                                               
    $result = $conn->query($sql_find);
    if ($result->num_rows >0)
    {
        echo "<br>Here are the results of your search:<br>";
        echo 'UserID||FirstName||LastName||StartYear||GraduationYear||Email||
            Acctype||Major||Minor||Employer||JobTitle<br>';
        while($row = $result->fetch_assoc())
        {
            

            echo $row['UserID'];echo "||";echo $row['FirstName'];echo "||";echo $row['LastName'];
            echo "||";echo $row['StartYear'];echo'||';echo $row['GraduationYear'];echo'||';
            echo $row['Email'];echo'||'; echo $row['Acctype'];echo"||"; echo $row['Major'];
            echo "||";echo $row['Minor']; echo '||';echo $row['Employer'];echo'||';echo $row['JobTitle'];
            echo '<br> <br>';
        }
        
    }
	else {
		echo "<br>There are no results for your search";
	}
}
if ($choice == "Community")
{
    echo "You searched $searched in $choice";

    $sql_find =  "SELECT * FROM community WHERE CommID = '$searched' OR
                                                CommName = '$searched' OR
                                                PCSEAffiliate = '$searched'OR
                                                YearCreated = '$searched'OR
                                                MemberCount = '$searched' OR
                                                PostCount = '$searched'";
                                               
    $result = $conn->query($sql_find);
    if ($result->num_rows >0)
    {
        echo "<br>Here are the results of your search:<br>";
        echo 'CommID||CommName||PCSEAffiliate||YearCreated||MemberCount||PostCount<br>';
            
        while($row = $result->fetch_assoc())
        {   echo $row['CommID'];echo "||";echo $row['CommName'];echo "||";echo $row['PCSEAffiliate'];
            echo "||";echo $row['YearCreated'];echo'||';echo $row['MemberCount'];echo'||';
            echo $row['PostCount'];
        }  
    }
	else {
		echo "There are no results for your search ";
	}
}
?>