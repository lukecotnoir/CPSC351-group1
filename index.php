<?php
include_once(realpath("resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="public_html/css/home-styling.css" rel="stylesheet">
<div class="home">
    <div class="content">
        <p class="greet">Welcome!<br>PCSE Student-Alumni Connection System</p>
        <p>This system provides a platform for current PCSE students and alumni to connect.</p>
        <?php
            if (isset($_SESSION['email'])) {
                echo "<p>You have successfully been logged in!</p>";
            }
            else {
                echo "<p>To get started, click <a href='/CPSC351-GROUP1/pages/accounts/Login.php'>here</a> to sign in or create a new account.</p>";
            }
        ?>
    </div>
</div>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>