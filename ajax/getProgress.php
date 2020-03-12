<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"]))
    {
        $query = $con->prepare("SELECT progress FROM videoprogress WHERE username=:username AND videoId=:videoId"); // Gets the time that was left at from the database
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();

        echo $query->fetchColumn(); // returning the one column
    }
    else
    {
        echo "No Video ID or Username passed into file";
    }
?>