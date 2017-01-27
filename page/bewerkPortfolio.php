<?php
//roept getportfolio functie met ingelogde user om de portfolio op te halen.
$core = new Core;
$core->getPortfolio($_SESSION['id']);
?>