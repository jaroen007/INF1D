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
		
	
	//Deze functie is om de juiste pagina weer te geven uit de bestanden
    function page($page) {
        if (!file_exists('page/' . $page . '.php')) {
            include 'page/home.php';
        } else {
            include 'page/' . $page . '.php';
        }
    }
	
    //hiervandaan wordt het portfolio weergegeven
    function getPortfolioContent($id, $tag) {
        $dbc = $this->dbc();
        $sql = "SELECT `Content`, `Tags` FROM `content` WHERE Tags='" . $tag . "' AND UserID=" . $id . ";";
        if (mysqli_query($dbc, $sql)) {
            $result = mysqli_query($dbc, $sql);
            echo '<p>&nbsp;&nbsp;</p>'
            . '<ul class="topbar portfolio" style="background-color: #90aed5;margin-top:30px">'
            . '<li class="item left"> <a href="?portfolio=' . $id . '">Over mij</a></li>'
            . '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Ervaring" . '">Ervaring</a></li>'
            . '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Opleidingen" . '">Opleidingen</a></li>'
            . '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Interesses" . '">Interesses</a></li>'
            . '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Overige" . '">Overige</a></li>'
            . '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Contact" . '">Contact</a></li>'
            . '</ul><div class="contentcontainer">
    <div class="content">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<h2>' . $row['Tags'];
                if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
                    echo ' <a href="?editPortfolio=' . $id . '&tag=' . $row['Tags'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>';
                } else {
                    echo '</h2>';
                }
                echo $row['Content'];
            }
            echo '</div></div>';
        } else {
            include 'page/home.php';
        }
    }

//het bewerk formulier van het portfolio
    function getPortfolio($id, $tag) {
        $dbc = $this->dbc();
        $sql = 'SELECT * FROM `content` WHERE UserID=' . $_SESSION['id'] . " AND Tags='" . $tag . "'";
        if (mysqli_query($dbc, $sql)) {
            $result = mysqli_query($dbc, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $contentID = $row['ContentID'];
                $content = $row['Content'];
                echo '<p>&nbsp;&nbsp;</p><div class="contentcontainer">
                         <div class="content">'
                . '<form action="';
                echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?updatePortfolio=' . $_SESSION['id'] . '&tag=' . $tag . '" method="post">
                    
                             <div class="c_1">
                <h1>Bewerk je eigen portfolio</h1>
                <p>
                    <input name="userID" value="' . $_SESSION['id'] . '" type="hidden">
                    <input name="contentID" value="' . $contentID . '" type="hidden">
                </p>
                <p class="inputNaam">
                    ' . $tag . ':
                </p>
                <p>
                    <textarea class="invoerveldGroot" name="portfolioContent">' . $content . '</textarea>
                </p>
                <p>
                    <input class="invoerveld" type="submit" value="opslaan">
                </p>
            </div>
            </form>
            ';
            }
        } else {
            include 'page/home.php';
        }
    }

    //Hier wordt het portfolio aangemaakt uit het formulier
    function makePortfolio($userID, $content, $tags) {
        $dbc = $this->dbc();
        $currentDate = date("Y-m-d");
        $sql = "INSERT INTO `content` (`UserID`, `Content`, `Tags`, `Date`) VALUES ('" . $userID . "', '" . mysqli_real_escape_string($dbc, $content) . "', '" . $tags . "', '" . $currentDate . "');";
        mysqli_query($dbc, $sql) or die("De pagina kan niet worden aangemaakt");
    }

    //Hier wordt het portfolio geupdate
    function editPortfolio($userID, $content, $tags) {
        $dbc = $this->dbc();
        $sql = 'UPDATE content SET Content = "' . mysqli_real_escape_string($dbc, $content) . '"  WHERE UserID = ' . $userID . ' AND Tags="' . $tags . '";';
        mysqli_query($dbc, $sql) or die("De pagina kan niet worden aangepast");
    }

    //check of het portfolio bestaat
    function portfolioBestaat() {
        $dbc = $this->dbc();
        $sql = "SELECT * FROM `content` WHERE UserID=" . $_SESSION['id'];
        $result = mysqli_query($dbc, $sql) or die("Het portfolio kan niet gevonden worden");
        if ($result->num_rows == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	// Input velden opruimen van code en andere html tekens
	function Sanitize($input){
		require("inc/conn.php");
		
		$input 		= stripslashes($input);
		$input		= mysqli_real_escape_string($conn, $input);
		$input		= htmlentities($input);
		
		return $input;
	}
}
?>