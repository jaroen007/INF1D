<?php
//logt je uit en stuurt je naar home paginaa
session_destroy();
header("Location: index.php");
exit;
?>