<?php
    class PreviewProvider
    {
        private $con;
        private $username;

        public function __construct($con, $username)
        {
            $this->con = $con;
            $this->username = $username;
        }

        public function createPreviewVideo($entity)
        {
            if($entity == null) // If there's no entity given, find a random one
            {
                $entity = $this->getRandomEntity();
            }

            // gets data

            $id = $entity->getId();
            $name = $entity->getName();
            $preview = $entity->getPreview();
            $thumbnail = $entity->getThumbnail();

            // add subtitles later

            // creates preview that autoplays a preview video given from a random entity (from our random entity function) and then shows the entity's thumbnail after the video ends

            return "<div class='previewContainer'>

                        <img src='$thumbnail' class='previewImage' hidden>

                        <video autoplay muted class='previewVideo' onended='previewEnded()'>
                            <source src='$preview' type='video/mp4'>
                        </video>

                        <div class='previewOverlay'>
                            <div class='mainDetails'>
                                <h3>$name</h3>

                                <div class='buttons'>
                                    <button><i class='fas fa-play'></i> Play</button>
                                    <button onclick='volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                                </div>
                            </div>
                        </div>

                    </div>";
        }

        public function createEntityPreviewSquare($entity) // creates preview for the entity for the user to click on and to go to that entities page to watch it
        {
            // gets entity's data

            $id = $entity->getId();
            $thumbnail = $entity->getThumbnail();
            $name = $entity->getName();

            // creates a small preview of that entity that displays its data with html and css and make it have an entity page of its own

            return "<a href='entity.php?id=$id'>
                        <div class='previewContainer small'>
                            <img src='$thumbnail' title='$name'>
                        </div>
                    </a>";
        }

        private function getRandomEntity()
        {
            $entity = EntityProvider::getEntities($this->con, null, 1);
            return $entity[0];
        }
    }
?>