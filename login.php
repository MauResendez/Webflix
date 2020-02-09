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
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username, $password);

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
        <title>Login to Webflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>

    <body>
        <div class="signInContainer">

            <div class="column">
                <div class="header">
                    <img src="assets/images/logo.png" title="Logo" alt="Site Logo"/>
                    <h3>Sign In</h3>
                </div>

                <form method="POST">

                    <?php echo $account->getError(Constants::$loginFailed); ?>

                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username")?>" required>

                    <input type="password" name="password" placeholder="Password" value="<?php getInputValue("password")?>" required>

                    <input type="submit" name="submitButton" value="Submit" required>

                </form>

                <a href="register.php" class="signUpMessage">Don't have an account? Sign up here!</a>

            </div>

        </div>
    </body>
</html>