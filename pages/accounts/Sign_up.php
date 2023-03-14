<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $email         = $_POST['email'];
    $fName         = $_POST['fName'];
    $lName         = $_POST['lName'];
    $startYr       = $_POST['startYr'];
    $gradYr        = $_POST['gradYr'];
    $major         = $_POST['major'];
    $minor         = $_POST['minor'];
    $acctype       = $_POST['acctype'];
    $empl          = $_POST['empl'];
    $job           = $_POST['job'];
    $pword         = $_POST['pword'];
    $confirm_pword = $_POST['confirm_pword'];
}
?>
<link href=/CPSC351-GROUP1/public_html/css/sign_up-styling.css rel="stylesheet">
<div class=login-form>
    <form action="Sign_up.php" method="post">
        <div class="title"><p>Enter information to register for a new account:</p></div>
        <hr style="width: 75%">
        <p style="color: var(--text-gray)">Fields indicated with * are required.</p>
        <div class="line">
            <p>* Email (CNU or work Email):&nbsp</p> 
            <div class="text-box"><input type="text" name="email" value="<?php if(isset($email)) echo $email;?>"></div>
        </div>
        <div class="two-items">
            <div class="line">
                <p>* First name:&nbsp</p>
                <div class="text-box"><input type="text" name="fName" value="<?php if(isset($fName)) echo $fName; ?>"></div>
            </div>
            <div class="line">
                <p>* Last name:&nbsp</p>
                <div class="text-box"><input type="text" name="lName" value="<?php if(isset($lName)) echo $lName; ?>"></div>
            </div>
        </div>
        <div class="two-items">
            <div class="line">
                <p>Start Year:&nbsp</p>
                <div class="text-box"><input type="text" name="startYr" value="<?php if(isset($startYr)) echo $startYr; ?>"></div>
            </div>
            <div class="line">
                <p>* Grad Year:&nbsp</p>
                <div class="text-box"><input type="text" name="gradYr" value="<?php if(isset($gradYr))echo $gradYr; ?>"></div>
            </div>
        </div>
        <div class="two-items">
            <div class="line">
                <p>Major(s):</p>
                <div class="text-box"><input type="text" name="major" value="<?php if(isset($major)) echo $major; ?>"></div>
            </div>
            <div class="line">
                <p>Minor(s):</p>
                <div class="text-box"><input type="text" name="minor" value="<?php if(isset($minor)) echo $minor; ?>"></div>
            </div>
        </div>
        <div class="line">
            <p>* Account Type:</p>
            <div class="accSelect">
                <div class="acctype">
                    <input type="radio" id="student" name="acctype" value="Student" onclick="studentAlumni()" checked="checked">
                    <label for="student">Student</label>
                </div>
                <div class="acctype">
                    <input type="radio" id="alum" name="acctype" value="Alumni" onclick="studentAlumni()">
                    <label for="alum">Alumni</label>
                </div>
            </div>
        </div>
        <div id="textboxes" class="two-items" style="display: none">
            <div class="line">
                <p>Employer:&nbsp</p>
                <div class="text-box"><input type="text" name="empl" value="<?php if(isset($empl)) echo $empl; ?>"></div>
            </div>
            <div class="line">
                <p>Job Title:&nbsp</p>
                <div class="text-box"><input type="text" name="job" value="<?php if(isset($job)) echo $job; ?>"></div>
            </div>
        </div>
        <script>
        function studentAlumni() {
            var x = document.getElementById("alum");
            if (x.checked) {
              document.getElementById("textboxes").style.display="flex";
            } else {
              document.getElementById("textboxes").style.display="none";
            }
        }
        </script>
        <div class="line">
            <p>* Create Password:&nbsp</p>
            <div class=text-box><input type="text" name="pword"></div>
        </div>
        <div class="line">
            <p>* Confirm Password:&nbsp</p>
            <div class=text-box><input type="text" name="confirm_pword"></div>
        </div>
        <div class="terms"><p>By creating an account you agree to our <a href="Sign_up.php">terms and conditions</a></p></div>
        <div class=button><input type="submit" name="submit"></div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_error_flag = true;

    $form_filter = array(
        'fName'         => FILTER_UNSAFE_RAW,
        'lName'         => FILTER_UNSAFE_RAW,
        'email'         => FILTER_SANITIZE_EMAIL,
        'startYr'       => FILTER_SANITIZE_NUMBER_INT,
        'gradYr'        => FILTER_SANITIZE_NUMBER_INT,
        'major'         => FILTER_UNSAFE_RAW,
        'minor'         => FILTER_UNSAFE_RAW,
        'acctype'       => FILTER_UNSAFE_RAW,
        'empl'          => FILTER_UNSAFE_RAW,
        'job'           => FILTER_UNSAFE_RAW,
        'pword'         => FILTER_UNSAFE_RAW,
        'confirm_pword' => FILTER_UNSAFE_RAW
    );

    $optional_fields = array(
        'startYr' => "",
        'major'   => "",
        'minor'   => "",
        'empl'    => "",
        'job'     => ""
    );

    $error_description = array(
        'fName' => "Missing required First Name",
        'lName' => "Missing required Last Name",
        'email' => "Missing or invalid Email",
        'gradYr' => "Missing or invalid grad year",
        'acctype' => "Missing account type",
        'pword' => "Missing password or passwords don't match",
        'confirm_pword' => "Missing password"
    );
    $form_data = filter_input_array(INPUT_POST, $form_filter);
    foreach($form_data as $form_input => $value){
        if($form_input == 'pword') {
            if($pword !== $confirm_pword){
                $invalid_inputs[] = $form_input;
            }
        }
        elseif($value === FALSE || $value === NULL || $value == ""){
            if(!(array_key_exists($form_input, $optional_fields) && $value == "")){
                $invalid_inputs[] = $form_input;
            }
        }
    }
    if(empty($invalid_inputs)){
        $input_error_flag = false;
    }
    if ($input_error_flag){
        foreach($invalid_inputs as $key => $form_input){
            if(array_key_exists($form_input, $error_description)){
                echo "<div class='line'><p style='color: red'>".$error_description[$form_input]."</p></div>";
            }
        }
    }
    else{
        include_once(realpath(CONNECTION_PATH));
        $sql = "SELECT * FROM Accounts where Email = '".$email."'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "<div class='line'><p>It looks like you already have an account. Go back to the login page to log in</p></div>";
        }
        else {
            $sql = "INSERT INTO Accounts (FirstName, LastName, StartYear, GraduationYear, Email, Acctype, Major, Minor, Employer, JobTitle, Password) 
            VALUES ('".$fName."', '".$lName."', '".(int) $startYr."', '".$gradYr."', '".$email."', '".$acctype."', '".$major."', '".$minor."', '".$empl."', '".$job."', '".$pword."')";
            $conn->query($sql);
            echo "<div class='line'><p>Success!</p></div>";
        }
    }
}
?>

    </form>
</div>
<?php

include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>