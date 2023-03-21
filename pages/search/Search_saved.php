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
include_once(realpath(CONNECTION_PATH));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            echo "<table border='1'>
            <tr>
            <th>UserID</th><th>FirstName</th><th>LastName</th><th>StartYear</th>
            <th>GraduationYear</th><th>Email</th><th>Acctype</th><th>Major</th>
            <th>Minor</th><th>Employer</th><th>JobTitle</th>
            </tr>
            ";
            
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                        <td>{$row['UserID']}</td>
                        <td>{$row['FirstName']}</td>
                        <td>{$row['LastName']}</td>
                        <td>{$row['StartYear']}</td>
                        <td>{$row['GraduationYear']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Acctype']}</td>
                        <td>{$row['Major']}</td>
                        <td>{$row['Minor']}</td>
                        <td>{$row['Employer']}</td>
                        <td>{$row['JobTitle']}</td>
                </tr>";
            }
            echo "</table>";
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
            echo "<table border='1'>
            <tr>
            <th>CommID</th><th>CommName</th><th>PCSEAffiliate</th>
            <th>YearCreated</th><th>MemberCount</th><th>PostCount</th>
            </tr>
            ";
            while($row = $result->fetch_assoc())
            {   echo "<tr>
                        <td>{$row['CommID']}</td>
                        <td>{$row['CommName']}</td>
                        <td>{$row['PCSEAffiliate']}</td>
                        <td>{$row['YearCreated']}</td>
                        <td>{$row['MemberCount']}</td>
                        <td>{$row['PostCount']}</td>
                </tr>";
            }
            echo "</table>"; 
        }
        else {
            echo "<br>There are no results for your search ";
        }
    }
}
?>