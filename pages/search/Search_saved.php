<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="../../public_html/css/search_page-styling.css" rel="stylesheet">
<div class="search-form">
    <form action="Search_saved.php" method="post">
        <div class="line">
            <p>What are you searching for:</p>
            <div class="SearchSelect">
                <div class="searchtype">
                    <input type="radio" id="account" name="search_type" value="Account">
                    <label for="account">Account</label>
                </div>
                <div class="searchtype">
                    <input type="radio" id="community" name="search_type" value="Community">
                    <label for="community">Community</label>
                </div>
           </div>
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
$choice = $_POST['search_type'];
if ($choice =="Account" )
{   
    echo "You are searching $searched in $choice";
    $sql_find =  "SELECT * FROM accounts WHERE FirstName LIKE '$searched%' OR
                                                LastName LIKE '$searched%' OR
                                               StartYear LIKE '$searched%'OR 
                                               GraduationYear LIKE '$searched%' OR
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
        {   echo $row['UserID'];echo "||";echo $row['FirstName'];echo "||";echo $row['LastName'];
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
    echo "You are searching $searched in $choice";

    $sql_find =  "SELECT * FROM community WHERE CommName LIKE '$searched%' OR
                                                PCSEAffiliate LIKE '$searched%'OR
                                                YearCreated LIKE '$searched%'";
                                               
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
		echo "<br>There are no results for your search ";
	}
}
?>