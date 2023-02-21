<?php
include_once(realpath("resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href=public_html/css/sign_up-styling.css rel="stylesheet">
<div class=login-form>
    <form action="Sign_up.php" method="post">
        <div class="title"><p>Enter information to register <br>for a new account:</p></div>
        <div class="line">
            <p>Email (CNU or work Email):&nbsp</p> 
            <div class=text-box><input type="text" name="email"></div>
        </div>
        <div class="two-items">
            <div class="line">
                <p>First name:&nbsp</p>
                <div class=text-box><input type="text" name="fName"></div>
            </div>
            <div class="line">
                <p>Last name:&nbsp</p>
                <div class=text-box><input type="text" name="lName"></div>
            </div>
        </div>
        <div class="two-items">
            <div class="line">
                <p>Start Year:&nbsp</p>
                <div class=text-box><input type="text" name="startYr"></div>
            </div>
            <div class="line">
                <p>Grad Year:&nbsp</p>
                <div class=text-box><input type="text" name="gradYr"></div>
            </div>
        </div>
        <div class="line">
            <p>Account Type:&nbsp</p>
            <input type="radio" id="student" name="acctype" value="Student" checked="checked">
            <label for="student">Student</label>
            <input type="radio" id="alum" name="acctype" value="Alumni">
            <label for="alum">Alumni</label>
        </div>
        <div class="line">
            <p>Create Password:&nbsp</p>
            <div class=text-box><input type="text" name="pword"></div>
        </div>
        <div class="line">
            <p>Confirm Password:&nbsp</p>
            <div class=text-box><input type="text" name="pword"></div>
        </div>
        
        <div class=button><input type="submit" name="submit"></div>
    </form>
</div>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>