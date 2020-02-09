<?php
    require_once("includes/classes/Account.php");
    require_once("includes/classes/Constants.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/config.php");

    $account = new Account($con);

    if(isset($_SESSION["userLoggedIn"])) // If you were already signed in, go back to the index page
    {
        header("Location: index.php");
    }

    if(isset($_POST["submitButton"]))
    {
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

        if($success)
        {
            $_SESSION["userLoggedIn"] = $username; // Saves that username is logged in
            header("Location: index.php"); // Takes you to the index page if register was a success or true
        }
    }

    function getInputValue($value)
    {
        if(isset($_POST[$value]))
        {
            echo $_POST[$value];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register to Webflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>

    <body>
        <div class="signInContainer">

            <div class="column">
                <div class="header">
                    <img src="assets/images/logo.png" title="Logo" alt="Site Logo"/>
                    <h3>Sign Up</h3>
                </div>

                <form method="POST">
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="First Name" value="<?php getInputValue("firstName")?>" required>

                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Last Name" value="<?php getInputValue("lastName")?>" required>

                    <?php echo $account->getError(Constants::$userNameCharacters); ?>
                    <?php echo $account->getError(Constants::$userNameTaken); ?>
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username")?>" required>

                    <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email")?>" required>

                    <input type="email" name="email2" placeholder="Confirm Email" value="<?php getInputValue("email2")?>" required>

                    <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                    <?php echo $account->getError(Constants::$passwordCharacters); ?>
                    <input type="password" name="password" placeholder="Password" value="<?php getInputValue("password")?>" required>

                    <input type="password" name="password2" placeholder="Confirm Password" value="<?php getInputValue("password2")?>" required>

                    <input type="submit" name="submitButton" value="Submit" required>
                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>

        </div>
    </body>
</html>