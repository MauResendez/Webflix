<?php
    class Video
    {
        private $con, $sqlData, $entity;

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

            $this->entity = new Entity($con, $this->sqlData["entityId"]); // Gets entity with the sqldata given to us
        }

        public function getId()
        {
            return $this->sqlData["id"];
        }

        public function getTitle()
        {
            return $this->sqlData["title"];
        }
        
        public function getDescription()
        {
            return $this->sqlData["description"];
        }

        public function getFilepath()
        {
            return $this->sqlData["filePath"];
        }

        public function getThumbnail()
        {
            return $this->entity->getThumbnail();
        }

        public function getEpisodeNumber()
        {
            return $this->sqlData["episode"];
        }
    }
?>