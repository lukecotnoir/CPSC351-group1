
<?php
    include_once(realpath("resources/config.php"));
    include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href="public_html/css/home-styling.css" rel="stylesheet">
<div class="home">
    <div class="content">
        <p class="greet">Welcome!<br>PCSE Student-Alumni Connection System</p>
        <p>This system provides a platform for current PCSE students and alumni to connect.</p>
        <p>To get started, click <a href="#">here</a> to sign in or create a new account.</p>
    </div>
</div>
<?php
    include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>