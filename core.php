<?php
//Een class met Core functies. 
//PS: vergeet niet een comment regel boven gemaakte functies te zetten zodat iedereen weet wat het doet!!!!!!!!!!!!!!!!!!!!!!!!!
class Core {

	//DB verbinding doormiddel van Mysqli.
	function dbc($servername = 'localhost', $username = 'root', $password = '', $dbname = 'portfolio') {  
		$link = mysqli_connect($servername, $username, $password, $dbname);

		if (!$link) {
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
    } 
	
	function language()
    {
        if (!isset($_SESSION['language']))
        {
            $language = "dutch";
        } else
        {
            $language = $_SESSION['language'];
        }
        return $language;
    }	
}
?>