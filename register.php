<?php
    if(isset($_POST["submitButton"]))
    {
        echo "Form was submitted";
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
                    <input type="text" name="firstName" placeholder="First Name" required>

                    <input type="text" name="lastName" placeholder="Last Name" required>

                    <input type="text" name="username" placeholder="Username" required>

                    <input type="email" name="email" placeholder="Email" required>

                    <input type="email" name="email2" placeholder="Confirm Email" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <input type="password" name="password2" placeholder="Confirm Password" required>

                    <input type="submit" name="submitButton" value="Submit" required>
                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>

        </div>
    </body>
</html>