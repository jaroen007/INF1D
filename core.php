<?php
//Een class met Core functies. 
//PS: vergeet niet een comment regel boven gemaakte functies te zetten zodat iedereen weet wat het doet!!!!!!!!!!!!!!!!!!!!!!!!!
class Core {

	//DB verbinding doormiddel van Mysqli.
	function dbc($servername = 'localhost', $username = 'root', $password = '', $dbname = 'portfolio') {  
		$dbc = mysqli_connect($servername, $username, $password, $dbname);

		if (!$dbc) {
			return "Error: Unable to connect to MySQL." . PHP_EOL;
			return "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			return "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		return $dbc;
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