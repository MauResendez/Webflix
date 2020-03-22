<?php
    class EntityProvider
    {
        public static function getEntities($con, $categoryId, $limit)
        {
            $sql = "SELECT * FROM entities ";

            if($categoryId != null) // if category id is provided to you, query for entities that have that categoryid
            {
                $sql .= "WHERE categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null)
            {
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT); // That this is an integer value that it's binding
            $query->execute();

            $result = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $result[] = new Entity($con, $row); // Use next available space when empty brackets are there
            }

            return $result;
        }

        public static function getTVEntities($con, $categoryId, $limit)
        {
            $sql = "SELECT DISTINCT(entities.id) 
                    FROM entities 
                    INNER JOIN videos 
                    ON entities.id = videos.entityId 
                    WHERE videos.isMovie = 0 "; // Uses inner join to get non duplicate entity ids from
                                                // columns that have the same entity id where the video is not a movie                                                                                

            if($categoryId != null) // if category id is provided to you, query for entities that have that categoryid
            {
                $sql .= "AND categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null)
            {
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT); // That this is an integer value that it's binding
            $query->execute();

            $result = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $result[] = new Entity($con, $row["id"]); // Use next available space when empty brackets are there
            }

            return $result;
        }

        public static function getMovieEntities($con, $categoryId, $limit)
        {
            $sql = "SELECT DISTINCT(entities.id) 
                    FROM entities 
                    INNER JOIN videos 
                    ON entities.id = videos.entityId 
                    WHERE videos.isMovie = 1 "; // Uses inner join to get non duplicate entity ids from
                                                // columns that have the same entity id where the video is a movie                                                                                

            if($categoryId != null) // if category id is provided to you, query for entities that have that categoryid
            {
                $sql .= "AND categoryId=:categoryId ";
            }

            $sql .= "ORDER BY RAND() LIMIT :limit";

            $query = $con->prepare($sql);

            if($categoryId != null)
            {
                $query->bindValue(":categoryId", $categoryId);
            }

            $query->bindValue(":limit", $limit, PDO::PARAM_INT); // That this is an integer value that it's binding
            $query->execute();

            $result = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $result[] = new Entity($con, $row["id"]); // Use next available space when empty brackets are there
            }

            return $result;
        }
    }
?>