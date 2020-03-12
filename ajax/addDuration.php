<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"]))
    {
        $query = $con->prepare("SELECT * FROM videoprogress WHERE videoId=:videoId AND username=:username"); // Setting up a query that checks if there's a row that exists with the videoId and username
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":username", $_POST["username"]);

        $query->execute();

        if($query->rowCount() == 0) // If there's no row that exists with the videoId and username, create a new one
        {
            $query = $con->prepare("INSERT INTO videoprogress (username, videoId) VALUES (:username, :videoId)");
            $query->bindValue(":videoId", $_POST["videoId"]);
            $query->bindValue(":username", $_POST["username"]);

            $query->execute();
        }
    }
    else
    {
        echo "No Video ID or Username passed into file";
    }
?>