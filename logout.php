<?php
    session_start(); // To have sessions available to us to be able to destroy it
    session_destroy();
    header("Location: login.php");
?>