<?php
    require_once("../includes/config.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"]))
    {
        $query = $con->prepare("UPDATE videoprogress SET finished=1, progress=0 WHERE username=:username AND videoId=:videoId"); // Setting up a query that sets the finished to 1 to know that you finished watching it and to also reset the progress to 0
        $query->bindValue(":username", $_POST["username"]);
        $query->bindValue(":videoId", $_POST["videoId"]);

        $query->execute();
    }
    else
    {
        echo "No Video ID or Username passed into file";
    }
?>