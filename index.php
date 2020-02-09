<?php
    require_once("includes/config.php");

    if(!isset($_SESSION["userLoggedIn"])) // If the session is not set, go to the register page
    {
        header("Location: register.php");
    }
?>