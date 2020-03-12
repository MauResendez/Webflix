<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"]) && isset($_POST["progress"]))
    {
        $query = $con->prepare("UPDATE videoprogress SET progress=:progress, dateModified=NOW() WHERE username=:username AND videoId=:videoId"); // Setting up a query that updates the progress of a video that you are watching
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);
        $query->bindValue(":progress", $_POST["progress"]);

        $query->execute();
    }
    else
    {
        echo "No Video ID or Username passed into file";
    }
?>