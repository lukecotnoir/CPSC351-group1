<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $email         = $_POST['email'];
    $startYr       = $_POST['startYr'];
    $gradYr        = $_POST['gradYr'];
    $major         = $_POST['major'];
    $minor         = $_POST['minor'];
    $acctype       = $_POST['acctype'];
    if ($acctype == "Alumni"){
        $empl      = $_POST['empl'];
        $job       = $_POST['job'];
    } 
    else{$empl     = NULL;
         $job      = NULL;
    }   
}
if(!isset($_SESSION['email'])) {
    header("location:/CPSC351-group1/index.php");
}
?>
<link href="../../public_html/css/sign_up-styling.css" rel="stylesheet">
<div class=login-form>
    <form action="Edit_account.php" method="post">
        <div class=title style="width: 80%">
            <p>Edit your account info here</p>
        </div>
        <hr style="width: 75%">
        <div class="line">
                <p>Email (CNU or work Email):&nbsp;</p> 
                <div class="text-box"><input type="text" name="email" value="<?php echo $_SESSION['email'];?>"></div>
            </div>
            <div class="two-items">
                <div class="line">
                    <p>Start Year:&nbsp;</p>
                    <div class="text-box"><input type="text" name="startYr" value="<?php echo $_SESSION['startYr'];?>"></div>
                </div>
                <div class="line">
                    <p>Grad Year:&nbsp;</p>
                    <div class="text-box"><input type="text" name="gradYr" value="<?php echo $_SESSION['gradYr'];?>"></div>
                </div>
            </div>
            <div class="two-items">
                <div class="line">
                    <p>Major(s):</p>
                    <div class="text-box"><input type="text" name="major" value="<?php echo $_SESSION['major'];?>"></div>
                </div>
                <div class="line">
                    <p>Minor(s):</p>
                    <div class="text-box"><input type="text" name="minor" value="<?php echo $_SESSION['minor'];?>"></div>
                </div>
            </div>
            <div class="line">
                <p>Account Type:</p>
                <div class="accSelect">
                    <div class="acctype">
                        <input type="radio" id="student" name="acctype" value="Student" onclick="studentAlumni()" <?php if($_SESSION['accType'] == 'Student') echo "checked='checked'";?> >
                        <label for="student">Student</label>
                    </div>
                    <div class="acctype">
                        <input type="radio" id="alum" name="acctype" value="Alumni" onclick="studentAlumni()" <?php if($_SESSION['accType'] == 'Alumni') echo "checked='checked'";?>>
                        <label for="alum">Alumni</label>
                    </div>
                </div>
            </div>
            <div id="textboxes" class="two-items" <?php if($_SESSION['accType'] == 'Alumni') echo "style='display: flex'"; else echo "style='display: none'"; ?>>
                <div class="line">
                    <p>Employer:&nbsp;</p>
                    <div class="text-box" ><input type="text" name="empl" value="<?php echo $_SESSION['empl']; ?>"></div>
                </div>
                <div class="line">
                    <p>Job Title:&nbsp;</p>
                    <div class="text-box"><input type="text" name="job" value="<?php echo $_SESSION['jobTitle']; ?>"></div>
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
        <div class=button><input type="submit" name="submit" value="Submit Changes"></div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_error_flag = true;

    $form_filter = array(
        'email'         => FILTER_SANITIZE_EMAIL,
        'startYr'       => FILTER_SANITIZE_NUMBER_INT,
        'gradYr'        => FILTER_SANITIZE_NUMBER_INT,
        'major'         => FILTER_UNSAFE_RAW,
        'minor'         => FILTER_UNSAFE_RAW,
        'acctype'       => FILTER_UNSAFE_RAW,
        'empl'          => FILTER_UNSAFE_RAW,
        'job'           => FILTER_UNSAFE_RAW,
    );

    $optional_fields = array(
        'startYr' => "",
        'major'   => "",
        'minor'   => "",
        'empl'    => "",
        'job'     => ""
    );

    $error_description = array(
        'email' => "Missing or invalid Email",
        'gradYr' => "Missing or invalid grad year",
        'acctype' => "Missing account type",
    );
    $form_data = filter_input_array(INPUT_POST, $form_filter);
    foreach($form_data as $form_input => $value){
        if($value === FALSE || $value === NULL || $value == ""){
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
    else {
        include_once(realpath(CONNECTION_PATH));
        $sql = "UPDATE Accounts SET 
            Email = '".$email."', 
            StartYear = '".(int) $startYr."', 
            GraduationYear = '".$gradYr."', 
            Major = '".$major."', 
            Minor = '".$minor."', 
            Acctype = '".$acctype."', 
            Employer = '".$empl."',
            JobTitle = '".$job."' 
            WHERE Email= '".$_SESSION['email']."'";
        
        $ver = $conn->query($sql);
        if(!$ver)
            die ("The error is: " . mysqli_error($conn));
        else
            $_SESSION['email'] = $email;
            $_SESSION['startYr'] = $startYr;
            $_SESSION['gradYr'] = $gradYr;
            $_SESSION['accType'] = $acctype;
            $_SESSION['major'] = $major;
            $_SESSION['minor'] = $minor;
            $_SESSION['empl'] = $empl;
            $_SESSION['jobTitle'] = $job;
            echo "<script>location.href = '/CPSC351-group1/pages/accounts/Account.php';</script>";
        }
} 
?>
    </form> 
</div>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>