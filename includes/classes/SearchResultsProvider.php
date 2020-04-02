<?php
    class SearchResultsProvider
    {
        private $con, $username;

        public function __construct($con, $username)
        {
            $this->con = $con;
            $this->username = $username;
        }

        public function getResults($inputText)
        {
            $entities = EntityProvider::getSearchEntities($this->con, $inputText);

            $html = "<div class='previewCategories noScroll'>";

            $html .= $this->getResultHtml($entities);

            return $html . "</div>";
        }

        private function getResultHtml($entities) 
        {
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
                        <div class='entities'>
                            $entitiesHtml
                        </div>
                    </div>";
        }
    }
?>