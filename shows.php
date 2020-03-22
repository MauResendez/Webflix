<?php
    require_once("includes/header.php");

    $preview = new PreviewProvider($con, $userLoggedIn);
    echo $preview->createTVPreviewVideo();

    $containers = new CategoryContainers($con, $userLoggedIn);
    echo $containers->showTVCategories();
?>