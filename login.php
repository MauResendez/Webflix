<?php
    if(isset($_POST["submitButton"]))
    {
        echo "Form was submitted";
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

                    <input type="email" name="email" placeholder="Email" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <input type="submit" name="submitButton" value="Submit" required>

                </form>

                <a href="register.php" class="signUpMessage">Don't have an account? Sign up here!</a>

            </div>

        </div>
    </body>
</html>