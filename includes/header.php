<?php
    require_once("includes/config.php");
    require_once("includes/classes/CategoryContainers.php");
    require_once("includes/classes/Entity.php");
    require_once("includes/classes/EntityProvider.php");
    require_once("includes/classes/ErrorMessage.php");
    require_once("includes/classes/PreviewProvider.php");
    require_once("includes/classes/Season.php");
    require_once("includes/classes/SeasonProvider.php");
    require_once("includes/classes/User.php");
    require_once("includes/classes/Video.php");
    require_once("includes/classes/VideoProvider.php");


    if(!isset($_SESSION["userLoggedIn"])) // If the session is not set, go to the register page
    {
        header("Location: register.php");
    }

    $userLoggedIn = $_SESSION["userLoggedIn"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Webflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>

        <script src="https://kit.fontawesome.com/bea1a666c2.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="assets/js/script.js"></script>
    </head>

    <body>
        <div class='wrapper'>

        <?php
            if(!isset($hideNav)) // If hideNav variable is not set, include the navBar.php. Else, hide the navBar by not including it.
            {
                include_once("includes/navBar.php");
            }
        ?>
