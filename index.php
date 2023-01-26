<?php

    require_once("resources/config.php");
    require_once(TEMPLATES_PATH . "/header.php");
?>

<div id="container">
    <div id="content">
        <h1>This is the home page</h1>
        <h2>this is the test website</h2>
        <p>I dont know what else to put here</p>
    </div>
    <?php
        require_once(TEMPLATES_PATH . "/sidePanel.php");
    ?>
</div>

<?php
    require_once(TEMPLATES_PATH . "/footer.php");
?>