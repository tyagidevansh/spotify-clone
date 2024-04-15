<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValue($name) {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Musify!</title>

    <link rel="stylesheet" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src = "assets/js/register.js"></script>
</head>
<body>
    <script>
        // $(document).ready(function() {
        //     $("#loginForm").show();
        //     $("#registerForm").hide();
        // });
    </script>
    <div id = "background">
        <div id = "inputContainer">
            <form id = "loginForm" action="register.php" method="post">
                <h2>Login to your account</h2>
                <p>
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <label for="loginUsername">Username</label>
                    <input id = "loginUsername" name = "loginUsername" type="text" placeholder = "John Doe" required>
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input id = "loginPassword" name = "loginPassword" type="password" placeholder = "Your password" required>
                </p>
                <button type = "submit" name = "loginButton" > LOG IN</button>

                <div class = "hasAccountText">
                    <span id = "hideLogin"> Don't have an account yet? Signup here. </span>
                </div>
            </form>


            <form id = "registerForm" action="register.php" method="post">
                <h2>Create your free account</h2>
                <p>
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <label for="username">Username</label>
                    <input id = "username" name = "username" type="text" placeholder = "eg John Doe" value = "<?php getInputValue('username')?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="firstName">First name</label>
                    <input id = "firstName" name = "firstName" type="text" placeholder = "eg John" value = "<?php getInputValue('firstName')?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName">Last name</label>
                    <input id = "lastName" name = "lastName" type="text" placeholder = "eg Doe" value = "<?php getInputValue('lastName')?>" required>
                </p>
                <p>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <label for="email">Email</label>
                    <input id = "email" name = "email" type="email" placeholder = "eg johndoe420@mail.com" value = "<?php getInputValue('email')?>" required>
                </p>
                <p>
                    <label for="email2">Confirm Email</label>
                    <input id = "email2" name = "email2" type="text" placeholder = "eg johndoe420@mail.com" value = "<?php getInputValue('email2')?>" required>
                </p>

                <p>
                    <?php echo $account->getError(Constants::$passwordsCharacters); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <label for="password">Password</label>
                    <input id = "password" name = "password" type="password" placeholder = "Your password" value = "<?php getInputValue('password')?>" required>
                </p>
                <p>
                    <label for="password2">Confirm Password</label>
                    <input id = "password2" name = "password2" type="password" placeholder = "Your password" value = "<?php getInputValue('password2')?>" required>
                </p>
                <button type = "submit" name = "registerButton" >SIGN UP</button>

                <div class = "hasAccountText">
                    <span id = "hideRegister"> Already have an account? Login here. </span>
                </div>
            
            </form>
        </div>
    </div>
</body>
</html>