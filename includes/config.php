<?php
    ob_start(); // Turns on output buffering (Outputs the PHP first before outputting the HTML)
    session_start(); // Saves variables, values after closing pages (Used to tell if user is logged in or not even after the page was closed)
    date_default_timezone_set("America/Chicago");

    try
    {
        $con = new PDO("mysql:dbname=webflix;host=localhost", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch(PDOException $e)
    {
        exit("Connection failed: " .  $e->getMessage());
    }
?>