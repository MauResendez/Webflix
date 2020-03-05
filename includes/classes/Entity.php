<?php
    class Entity
    {
        private $con, $sqlData;

        public function __construct($con, $input)
        {
            $this->con = $con;

            if(is_array($input)) // if the data has already been passed into the function, make input equal that
            {
                $this->sqlData = $input;
            }
            else // else assume input is the id and use it to find the data from the entity that has that id
            {
                $query = $this->con->prepare("SELECT * FROM ENTITIES WHERE id=:id");
                $query->bindValue(":id", $input);
                $query->execute();

                $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
            }
        }

        public function getId() // gets id data
        {
            return $this->sqlData["id"];
        }

        public function getName() // gets name data
        {
            return $this->sqlData["name"];
        }

        public function getThumbnail() // gets thumbnail data
        {
            return $this->sqlData["thumbnail"];
        }

        public function getPreview() // gets preview data
        {
            return $this->sqlData["preview"];
        }

        public function getCategoryId() // gets preview data
        {
            return $this->sqlData["categoryId"];
        }

        public function getSeasons() // Gets seasons and episodes in order from first seasons to last season with episodes also being in order from first to last episode
        {
            $query = $this->con->prepare("SELECT * FROM videos WHERE entityId=:id AND isMovie=0 ORDER BY season, episode ASC");

            $query->bindValue(":id", $this->getId());
            $query->execute();

            $seasons = array();
            $videos = array();
            $currentSeason = null;

            while($row = $query->fetch(PDO::FETCH_ASSOC)) // queries through all the videos
            {
                if($currentSeason != null && $currentSeason != $row["season"])
                {
                    $seasons[] = new Season($currentSeason, $videos); // puts the new season in the next spot of the array
                    $videos = array(); // clearing the array
                }

                $currentSeason = $row["season"];
                $videos[] = new Video($this->con, $row); // puts a new video in the next spot of the array
            }

            if(sizeof($videos) != 0) // if videos array is not empty, put 
            {
                $seasons[] = new Season($currentSeason, $videos); // puts the new season in the next spot of the array
            }

            return $seasons;
        }
    }
?>