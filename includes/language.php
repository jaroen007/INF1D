<?php
    if (!session_id()) {
        session_start();
    }

    if (!isset($_SESSION['language'])) {
        $language = "dutch";
    } else {
        $language = $_SESSION['language'];
    }
?>