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

        public function getId()
        {
            return $this->sqlData["id"];
        }

        public function getName()
        {
            return $this->sqlData["name"];
        }

        public function getThumbnail()
        {
            return $this->sqlData["thumbnail"];
        }

        public function getPreview()
        {
            return $this->sqlData["preview"];
        }
    }
?>