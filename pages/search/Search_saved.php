<?php
    include_once(realpath("../../resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="../../public_html/css/search_page-styling.css" rel="stylesheet">
<div class="search-form">
    <form action="Search_saved.php" method="post">
        <div class="title"><p>What are you searching for?</p></div>
        <hr style='width: 75%'>
        <div class="typeSelect">
            <div class="line">
                <input type="radio" id="account" name="search_type" value="Account" checked="checked">
                <label for="account">Account</label>
            </div>
            <div class="line">
                <input type="radio" id="community" name="search_type" value="Community">
                <label for="community">Community</label>
            </div>
        </div>
        <div class="line">
            <div class="text-box"><input type="text" name="searched"></div>
        </div>
        <div class=line>
            <div class="button"><input type="submit" name="Search"></div>
        </div>
    </form>
</div>
<?php
include_once(realpath(CONNECTION_PATH));
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searched = $_POST['searched'];
    $choice = $_POST['search_type'];
    if ($choice =="Account" )
    {
        $sql_find1 =  "SELECT * FROM accounts WHERE CONCAT( FirstName, ' ', LastName ) LIKE '%$searched%' OR
                                                    CONCAT( LastName, ' ', FirstName ) LIKE '%$searched%' OR
                                                    Email LIKE '%$searched%' OR
                                                    StartYear LIKE '%$searched%' OR 
                                                    GraduationYear LIKE '%$searched%' OR
                                                    Major LIKE '%$searched%' OR
                                                    Minor LIKE '%$searched%' OR
                                                    Employer LIKE '%$searched%' OR
                                                    JobTitle LIKE '%$searched%'";     
        $result1 = $conn->query($sql_find1);
        if (($result1->num_rows >0)) {
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Search Results</p></div>
            <table border='1'>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Graduation Year</th>
                <th>Account Type</th>
                <th>Major</th>
                <th>Minor</th>
                <th>Employer</th>
                <th>Job Title</th>
            </tr>
            ";
            $a = array();
            while($row = $result1->fetch_assoc()) {
                if(!in_array($row, $a)) {
                    $a[] = $row;
                }
            }
            foreach($a as $row)
            {   echo "<tr>
                        <td>{$row['FirstName']}</td>
                        <td>{$row['LastName']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['GraduationYear']}</td>
                        <td>{$row['Acctype']}</td>
                        <td>{$row['Major']}</td>
                        <td>{$row['Minor']}</td>
                        <td>{$row['Employer']}</td>
                        <td>{$row['JobTitle']}</td>
                </tr>";
            }
            echo "</table></div>";
        }
        else {
            echo "<br>There are no results for your search";
        }
    }
    if ($choice == "Community")
    {

        $sql_find =  "SELECT * FROM community WHERE CommName LIKE '$searched%' OR
                                                    PCSEAffiliate LIKE '$searched%'OR
                                                    YearCreated LIKE '$searched%'";
        $searched2 = explode(" ", $searched)[0];                                     
        $sql_find2 =  "SELECT * FROM community WHERE CommName LIKE '$searched%' OR
                                                    PCSEAffiliate LIKE '$searched%'OR
                                                    YearCreated LIKE '$searched%'";
        $searched3 = explode(" ", $searched)[1]; 
        $sql_find3 =  "SELECT * FROM community WHERE CommName LIKE '$searched%' OR
                                                    PCSEAffiliate LIKE '$searched%'OR
                                                    YearCreated LIKE '$searched%'";
        
        
        $result = $conn->query($sql_find);
        $result2 = $conn->query($sql_find2);
        $result3 = $conn->query($sql_find3);

        if (($result->num_rows >0) || ($result2->num_rows > 0) || ($result3->num_rows > 0))
        {   
            $a = array();
            while($row = $result->fetch_assoc()) {
                if(!in_array($row, $a)) {
                    $a[] = $row;
                }
            }
            while($row = $result2->fetch_assoc()) {
                if(!in_array($row, $a)) {
                    $a[] = $row;
                }
            }
            while($row = $result3->fetch_assoc()) {
                if(!in_array($row, $a)) {
                    $a[] = $row;
                }
            }
            echo "<div class='results_table'>
            <div class='title'><p style='text-decoration: underline;'>Search Results</p></div>
            <table border='1'>
            <tr>
            <th>CommID</th><th>CommName</th><th>PCSEAffiliate</th>
            <th>YearCreated</th><th>MemberCount</th><th>PostCount</th>
            </tr>
            ";
            foreach($a as $row)
            {   echo "<tr>
                        <td>{$row['CommID']}</td>
                        <td>{$row['CommName']}</td>
                        <td>{$row['PCSEAffiliate']}</td>
                        <td>{$row['YearCreated']}</td>
                        <td>{$row['MemberCount']}</td>
                        <td>{$row['PostCount']}</td>
                </tr>";
            }
            echo "</table></div>"; 
        }
        else {
            echo "<div class='title'><p>There are no results for your search</p></div> ";
        }
    }
}
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>