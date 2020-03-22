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

        public function showTVCategories()
        {
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>
                     <h1>TV Shows</h1>";

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $html .= $this->getCategoryHtml($row, null, true, false);
            }

            return $html . "</div>";
        }

        public function showMovieCategories()
        {
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='previewCategories'>
                     <h1>Movies</h1>";

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $html .= $this->getCategoryHtml($row, null, false, true);
            }

            return $html . "</div>";
        }

        public function showCategory($categoryId, $title = null)
        {
            $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
            $query->bindValue(":id", $categoryId);
            $query->execute();

            $html = "<div class='previewCategories noScroll'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                $html .= $this->getCategoryHtml($row, $title, true, true);
            }

            return $html . "</div>";
        }

        private function getCategoryHtml($sqlData, $title, $tvShows, $movies)
        {
            $categoryId = $sqlData["id"];
            $title = $title == null ? $sqlData["name"] : $title; // if title is null, use name (type of tv show or movie) given from the row data. Else use the title given to you

            if($tvShows && $movies)
            {
                $entities = EntityProvider::getEntities($this->con, $categoryId, 30); // returns the entity array that has everything
            }
            else if($tvShows)
            {
                $entities = EntityProvider::getTVEntities($this->con, $categoryId, 30); // returns the entity array that only has TV Shows
            }
            else if($movies)
            {
                $entities = EntityProvider::getMovieEntities($this->con, $categoryId, 30); // returns the entity array that only has movies
            }

            if(sizeof($entities) == 0) // if entity array is empty, just return
            {
                return;
            }

            $entitiesHtml = "";
            $previewProvider = new PreviewProvider($this->con, $this->username); // new Preview Provider to let you create the entity preview squares
            
            foreach($entities as $entity)
            {
                $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity); // Loops through entity array to create the html with the html returned by the function
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