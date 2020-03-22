<?php
    class VideoProvider
    {
        public static function getUpNext($con, $currentVideo) // queries to get the next video (First checks if the next episode is greater than the one you're watching. If it isn't, then the first video of the next season). Ordered by season first then episode
        {
            $query = $con->prepare("SELECT * from videos WHERE entityId=:entityId AND id != :videoId
            AND 
            (
                (season = :season AND episode > :episode) OR season > :season
            )
            ORDER BY season, episode ASC LIMIT 1");

            $query->bindValue(":entityId", $currentVideo->getEntityId());
            $query->bindValue(":season", $currentVideo->getSeasonNumber());
            $query->bindValue(":episode", $currentVideo->getEpisodeNumber());
            $query->bindValue(":videoId", $currentVideo->getId());

            $query->execute();

            if($query->rowCount() == 0) // If nothing came up aka the end of the show, give a different video or movie (season = 0 means movie) that is the most popular
            {
                $query = $con->prepare("SELECT * FROM videos WHERE season <= 1 AND episode <= 1 AND id != :videoId ORDER BY views DESC LIMIT 1");

                $query->bindValue(":videoId", $currentVideo->getId());
                $query->execute();
            }

            $row = $query->fetch(PDO::FETCH_ASSOC);

            return new Video($con, $row); 
        }

        public static function getEntityVideoForUser($con, $entityId, $username)
        {
            $query = $con->prepare("SELECT videoId FROM videoprogress
            INNER JOIN videos
            ON videoprogress.videoId = videos.id
            WHERE videos.entityId = :entityId 
            AND videoprogress.username = :username 
            ORDER BY videoprogress.dateModified 
            DESC LIMIT 1"); // this query selects the video that is next for the user to watch by using an inner join that combines the columns from both tables and gives us the videoId
                            // where the entityId is equal to the one we just clicked on and where videoprogress.username is equal to the current user's username.
                            // It's ordered by the latest dateModified meaning the one you just watched or recently watched will be that video.
            
            $query->bindValue(":entityId", $entityId);
            $query->bindValue(":username", $username);

            $query->execute();

            if($query->rowCount() == 0) // If the query didn't get any results (meaning they never watched it before which won't show up in the videoprogress table), get first episode
            {
                $query = $con->prepare("SELECT id FROM videos 
                WHERE entityId = :entityId 
                ORDER BY season, episode ASC 
                LIMIT 1");

                $query->bindValue(":entityId", $entityId);

                $query->execute();
            }

            return $query->fetchColumn(); // returns only one column

        }
    }
?>