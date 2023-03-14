<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="../../public_html/css/search-page-styling.css" rel="stylesheet">
<div class="search-form">
    <form action="Search_saved.php" method="post">
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
$searched = $_POST['searched'];
$choice = $_POST['dropdown'];        #Set as account now

if ($choice =="Account" )
{
    echo "You searched $searched in $choice";

    $sql_find =  "SELECT * FROM accounts WHERE FirstName = '$searched' OR
                                                LastName = '$searched' OR
                                                StartYear = '$searched' OR
                                                GraduationYear = '$searched' OR
                                                Email = '$searched' OR
                                                Acctype = '$searched' OR
                                                Major = '$searched' OR
                                                Minor = '$searched' OR
                                                Employer = '$searched' OR
                                                JobTitle = '$searched'";
                                               
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
		echo "There are no results for your search";
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