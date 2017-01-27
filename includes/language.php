<?php
	//regelt sessie voor welke taal de site moet late zien
    if (!isset($_SESSION['language'])) {
        $language = "dutch";
		$_SESSION["language"] = 'dutch';
    } elseif(isset($_GET['language'])){
        $_SESSION["language"] = $_GET['language'];
        $language = $_SESSION['language'];
    }else{
        $language = $_SESSION['language'];
	}
?>