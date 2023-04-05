<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 1 Site</title>
    <link href="/CPSC351-GROUP1/public_html/css/global.css" rel="stylesheet">
    <link rel="stylesheet" href="/CPSC351-GROUP1/public_html/css/header-styling.css">
</head>

<body>
    <div class="navbar">
        <div class="logo"><a href="/CPSC351-GROUP1/index.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Christopher_Newport_University_%28logo%29.svg/2560px-Christopher_Newport_University_%28logo%29.svg.png" alt="CNU Logo"></a></div>
        <div class="menu">
            <ul>
            <?php 
                if(isset($_SESSION['accType']) && ($_SESSION['accType'] == "Admin"))
                    echo "
                        <li>
                            <a href='#'>Admin +</a>
                            <ul>
                                <li><a href='/CPSC351-GROUP1/pages/reports/Reports_Admin.php'>Reports</a></li>
                                <li><a href='/CPSC351-GROUP1/pages/reports/Community_requests.php'>Requests</a></li>
                            </ul>
                        </li>
                    ";
                    
            ?>
            <li><a href="/CPSC351-GROUP1/pages/search/Search_saved.php">Search</a></li>
            <?php
                if(isset($_SESSION['email'])) {
                    echo "<li><a href='/CPSC351-GROUP1/pages/event_board/Event_board.php'>Event Board</a></li>";
                    echo "<li><a href='/CPSC351-GROUP1/pages/communities/Communities_view.php'>Communities</a></li>";
                    echo "<li><a href='/CPSC351-GROUP1/pages/messaging/Messaging.php'>Messages</a></li>";
                
                }
            ?>
                <li><a <?php if(isset($_SESSION['email'])) echo "href='/CPSC351-GROUP1/pages/accounts/Account.php'>Account"; else echo "href='/CPSC351-GROUP1/pages/accounts/Login.php'>Login";?></a></li>
            </ul>
        </div>
    </div>
