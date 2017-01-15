<?php
    if (!isset($_SESSION['language'])) {
        $language = "dutch";
    } elseif(isset($_GET['language'])){
        $_SESSION["language"] = $_GET['language'];
        $language = $_SESSION['language'];
    }else{
        $language = $_SESSION['language'];
	}
?>