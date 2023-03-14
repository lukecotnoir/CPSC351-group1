<?php
include_once(realpath("../../resources/config.php"));
include_once(realpath(TEMPLATES_PATH . "/header.php"));
?>
<link href=../../public_html/css/login-styling.css rel="stylesheet">
<div class=login-form>
    <form action="Login.php" method="post">
        <div class="title"><p>Enter your login information here:</p></div>
        <hr style="width: 75%">
        <div class="username">
            <p>Email:&nbsp</p> 
            <div class=text-box><input type="text" name="email"></div>
        </div>
        <div class="password">
            <p>Password:&nbsp</p>
            <div class=text-box><input type="password" name="pword" id="password"></div>
        </div>
        <div class="show-password"><input type="checkbox" onclick="myFunction()"><p style="font-size: 14px">Show Password</p></div>
        <script>
          function myFunction() {
             var x = document.getElementById("password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
        </script>
        <div class=button><input type="submit" name="submit"></div>
        <div class="sign-up">
            <p>Don't have an account: <a href=Sign_up.php>Sign up!</a></p>
        </div>
<?php
if(isset($_POST['email'], $_POST['pword'])) {
    $email = $_POST['email'];
    $pass = $_POST['pword'];

    include_once(realpath(CONNECTION_PATH));
    $sql = "SELECT * FROM accounts where Email = '".$email."' and Password = '".$pass."'";
    $result = $conn->query($sql);

    //db execute query
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($pass !== $row['Password']) {
            echo "<p>Incorrect password.</p>";
        }
    }
    else {
        echo "<p>It looks like you don't have an account.</p>";
    }

    $conn->close();
}
?>
    </form>
</div>
<?php
include_once(realpath(TEMPLATES_PATH . "/footer.php"));
?>