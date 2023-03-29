<?php
    include '../php/db_connection.php';
    // define variables and set to empty values
    $f_name_err = $l_name_err = $email_err = $password_err = "";
    $f_name = $l_name = $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["f_name"])) {
            $f_name_err = "Name is required";
        } else {
            $f_name = test_input($_POST["f_name"]);
            // check if f_name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$f_name)) {
                $f_name_err = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["l_name"])) {
            $l_name_err = "Name is required";
        } else {
            $l_name = test_input($_POST["l_name"]);
            // check if l_name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$l_name)) {
                $l_name_err = "Only letters and white space allowed";
            }
        }
        
        if (empty($_POST["email"])) {
            $email_err = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if signup e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
            }
        }
        
        if (empty($_POST["password"])) {
            $password_err = "Password is required";
        } else {
            // Given signup password
            $password = test_input($_POST["password"]);
            
            // Validate signup password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $password_err = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            }
        }
        echo "<h1>$f_name_err\n$l_name_err\n$email_err\n$password_err\"</h1>";
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html>

    
    <head>
        <title>EndangAID</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

    <div class="website">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="signup()">Signup</button>
            </div>
            <div id="logo-img" class="loimg" >
                <img src="../images/logo.png" alt="logo" class="center">
            </div>
            <form id="login" class="input-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> <!--add php action-->
                <h6>Log in</h6>
                <input type="text" class="input-field" placeholder="Email" required name="email">
                <input type="text" class="input-field" placeholder="Password" required name="password">
                <input type="checkbox" class="check-box"><span>Remember Password <a href="#"> Forgot Password?</a></span> <!-- TBD -->
                <button type="submit" class="submit-btn">Log In</button>
                                
            </form>
            <form id="signup" class="input-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h6>Sign up</h6>
                <input type="text" class="input-field" placeholder="First name" required name="f_name">
                <span class="alert-danger">* <?php echo $f_name_err;?></span>
                <input type="text" class="input-field" placeholder="Last name" required name="l_name">
                <span class="alert-danger">* <?php echo $l_name_err;?></span>
                <input type="text" class="input-field" placeholder="Email" required name="email">
                <span class="alert-danger">* <?php echo $email_err;?></span>
                <input type="text" class="input-field" placeholder="Password" required name="password">
                <span class="alert-danger">* <?php echo $password_err;?></span>
                
                <button type="submit" class="submit-btn">Sign up</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
