<?php

    if (!isset($_SESSION['language'])) {
        $language = "dutch";
    } else {
        $_SESSION["language"] = $_GET['language'];
        $language = $_SESSION['language'];
    }
?>