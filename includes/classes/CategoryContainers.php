<?php
    class CategoryContainers
    {
        private $con;
        private $username;

        public function __construct($con, $username)
        {
            $this->con = $con;
            $this->username = $username;
        }

        public function showAllCategories()
        {
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $html .= $this->getCategoryHtml($row, null, true, true);
            }

            return $html . "</div>";
        }

        private function getCategoryHtml($sqlData, $title, $tvShows, $movies)
        {
            $categoryId = $sqlData["id"];
            $title = $title == null ? $sqlData["name"] : $title; // if title is null, use name (type of tv show or movie) given from the row data. Else use the title given to you

            if($tvShows && $movies)
            {
                $entities = EntityProvider::getEntities($this->con, $categoryId, 30);
            }
            else if($tvShows)
            {
                // get tv show entities
            }
            else if($movies)
            {
                // get movies entities
            }

            if(sizeof($entities) == 0)
            {
                return;
            }

            $entitiesHtml = "";
            $previewProvider = new PreviewProvider($this->con, $this->username);
            
            foreach($entities as $entity)
            {
                $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
            }


            //return $entitiesHtml . "<br>"; // . means concatenation

            return "<div class='category'>
                        <a href='category.php?id=$categoryId'>
                            <h3>$title</h3>
                        </a>

                        <div class='entities'>
                            $entitiesHtml
                        </div>
                    </div>";

        }
    }
?>