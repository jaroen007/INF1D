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
//Deze functie is om de juiste pagina weer te geven uit de database
    function page($page) {
        if (!file_exists('page/' . $page . '.php')) {
            include 'page/home.php';
        } else {
            include 'page/' . $page . '.php';
        }
    }
    //hiervandaan wordt het portfolio weergegeven
    function getPortfolio($id) {
        $dbc = $this->dbc();
        $sql = 'SELECT `Content` FROM `content` WHERE ContentID=' . $id;
        echo $sql;
        if (mysqli_query($dbc, $sql)) {
            $result = mysqli_query($dbc, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<p>&nbsp;</p>';
                echo $row['Content'];
            }
        } else {
            include 'page/home.php';
        }
    }
    
    //Hier wordt het portfolio aangemaakt uit het formulier
    function makePortfolio($userID, $content, $tags) {
        $dbc = $this->dbc();
        $currentDate = date("Y-m-d");
        $sql = "INSERT INTO `content` (`ContentID`, `UserID`, `Content`, `Tags`, `Date`) VALUES (NULL, '" . 1 . "', '" . mysqli_real_escape_string($dbc, $content) . "', '" . $tags . "', '" . $currentDate . "');";
        
        mysqli_query($dbc, $sql) or die("De pagina kan niet worden aangemaakt");
    }
    //Hier wordt het portfolio geupdate
    function editPortfolio($userID, $content, $tags, $ContentID){
        $dbc = $this->dbc();
        $sql= "UPDATE `content` SET `Content` = '" . $content . "', Tags='" . $tags . "' WHERE `content`.`ContentID` = " . $ContentID .";";
         mysqli_query($dbc, $sql) or die("De pagina kan niet worden aangemaakt");
    }
}
?>