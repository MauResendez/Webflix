<?php
    require_once("includes/header.php");

    if(!isset($_GET["id"]))
    {
        ErrorMessage::show("No ID passed into the page");
    }

    $video = new Video($con, $_GET["id"]); // Creates video object
    $video->incrementViews();
?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <video controls autoplay>
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
</div>

<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>