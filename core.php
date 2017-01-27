<?php
//Een class met Core functies. 
class Core {
	//DB verbinding doormiddel van Mysqli.
    //lokaal: $servername = 'localhost', $username = 'root', $password = '', $dbname = 'portfolio'
	function dbc($servername = 'db.jaroeneefting.com', $username = 'md192121db371333', $password = 'gHG7Ha5P', $dbname = 'md192121db371333') {    
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
    function getPortfolioContent($id, $tag="Over Mij") {
        $dbc = $this->dbc();
        $sql = "SELECT `Content`, `Tags` FROM `content` WHERE Tags='" . $tag . "' AND UserID=" . $id . ";";
        if (mysqli_query($dbc, $sql)) {
            $result = mysqli_query($dbc, $sql);
			//haalt alle cijfers op en gebruikt ze op waarmerk op portfolio te laten zien.
			$sql2 = 'SELECT * FROM `grade` WHERE UserID=' . $_GET['portfolio'] . " AND Grade ='1'";
			$row = mysqli_query($dbc, $sql2);
			$rowarray = mysqli_fetch_assoc($row);
			$count = mysqli_num_rows($row);
			
			if($_SESSION['language'] == 'dutch'){
				//maakt portfolio headers op.
				echo'<ul class="topbar portfolio">'
				. '<li class="item left"> <a href="?portfolio=' . $id . '">Over mij</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Ervaring" . '">Ervaring</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Opleidingen" . '">Opleidingen</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Interesses" . '">Interesses</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Overige" . '">Overige</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Contact" . '">Contact</a></li>'
				. '<li class="item left divider-vertical"></li>'
				. '<li class="item left"> <a href="?page=fileOverview&user=' . $id . '">Documenten</a></li>'
				. '<li class="item left divider-vertical"></li>'
				. '<li class="item left"> <a href="?page=profiel&user=' . $id . '">Profiel</a></li>';
				if($count == 0){
					echo '<li class="item right port_approve"><i class="fa fa-times fa-2x" data-toggle="tooltip" data-placement="bottom" title="Dit portfolio is nog niet goed gekeurd." aria-hidden="true"></i></li>';
				}else{
					$sql3 = 'SELECT * FROM `user` WHERE UserID=' . $rowarray['GraderID'] . '';
					$row2 = mysqli_query($dbc, $sql3);
					$rowarray2 = mysqli_fetch_assoc($row2);
					echo '<li class="item right port_approve"><i class="fa fa-check fa-2x" data-toggle="tooltip" data-placement="bottom" title="Dit portfolio is goed gekeurd door: '.$rowarray2['FirstName'].' '.$rowarray2['LastName'].'." aria-hidden="true"></i></li>';
				}
				echo '</ul>';
				echo '<div class="clear"></div>';
			}else{
				//maakt portfolio headers op.
				echo'<ul class="topbar portfolio">'
				. '<li class="item left"> <a href="?portfolio=' . $id . '">About me</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Ervaring" . '">Experiences</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Opleidingen" . '">Studies</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Interesses" . '">Interests</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Overige" . '">Other</a></li>'
				. '<li class="item left"> <a href="?portfolio=' . $id . '&tag=' . "Contact" . '">Contact</a></li>'
				. '<li class="item left divider-vertical"></li>'
				. '<li class="item left"> <a href="?page=fileOverview&user=' . $id . '">Documents</a></li>'
				. '<li class="item left divider-vertical"></li>'
				. '<li class="item left"> <a href="?page=profiel&user=' . $id . '">Profile</a></li>';
				if($count == 0){
					echo '<li class="item right port_approve"><i class="fa fa-times fa-2x" data-toggle="tooltip" data-placement="bottom" title="This portfolio has not been approved." aria-hidden="true"></i></li>';
				}else{
					$sql3 = 'SELECT * FROM `user` WHERE UserID=' . $rowarray['GraderID'] . '';
					$row2 = mysqli_query($dbc, $sql3);
					$rowarray2 = mysqli_fetch_assoc($row2);
					echo '<li class="item right port_approve"><i class="fa fa-check fa-2x" data-toggle="tooltip" data-placement="bottom" title="This portfolio has been approved by: '.$rowarray2['FirstName'].' '.$rowarray2['LastName'].'." aria-hidden="true"></i></li>';
				}
				echo '</ul>';
				echo '<div class="clear"></div>';		
			}
            while ($row = mysqli_fetch_assoc($result)) {
				if($_SESSION['language'] == 'dutch'){
					//regelt tags in de url om portfolio te bewerken
					echo '<h2>' . $row['Tags'];
					if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
						if($row["Tags"] != "Over Mij"){
							echo ' <a href="?editPortfolio=' . $id . '&tag=' . $row['Tags'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>';
						}else{
							echo ' <a href="?editPortfolio=' . $id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>';
						}
						
					} else {
						echo '</h2>';
					}
				}else{
					//vertaling tags naar engels en weer terug naar nederlands.
					switch ($row['Tags']) {
						case "Over Mij":
							$row['Tags'] = "About Me";
							break;
						case "Ervaring":
							$row['Tags'] = "Experiences";
							break;
						case "Opleidingen":
							$row['Tags'] = "Studies";
							break;
						case "Interesses":
							$row['Tags'] = "Interests";
							break;
						case "Overige":
							$row['Tags'] = "Other";
							break;
						case "Contact":
							$row['Tags'] = "Contact";
							break;
						default:
							exit();
					}
				
					echo '<h2>' . $row['Tags'];

					switch ($row['Tags']) {
						case "Experiences":
							$row['Tags'] = "Ervaring";
							break;
						case "Studies":
							$row['Tags'] = "Opleidingen";
							break;
						case "Interests":
							$row['Tags'] = "Interesses";
							break;
						case "Other":
							$row['Tags'] = "Overige";
							break;
						case "Contact":
							$row['Tags'] = "Contact";
							break;
						default:
							$row['Tags'] = "Over Mij";
					}
					
					//regelt tags in de url om portfolio te bewerken
					if (isset($_SESSION['id']) && $_SESSION['id'] == $id) {
						if($row["Tags"] != "Over Mij"){
							echo ' <a href="?editPortfolio=' . $id . '&tag=' . $row['Tags'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>';
						}else{
							echo ' <a href="?editPortfolio=' . $id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>';
						}
					} else {
						echo '</h2>';
					}				
				}
                echo $row['Content'];
            }
        } else {
            include 'page/home.php';
        }
    }

	//het bewerk formulier van het portfolio
    function getPortfolio($id, $tag="Over%20Mij") {
        $dbc = $this->dbc();
        $sql = 'SELECT * FROM `content` WHERE UserID=' . $_SESSION['id'] . " AND Tags='" . $tag . "'";
        
		if($_SESSION['language'] == 'dutch'){
			if (mysqli_query($dbc, $sql)) {
				$result = mysqli_query($dbc, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					//opmaak voor portfolio bewerken. gebruikt hidden velden om te weten van wie het portfolio is.
					$contentID = $row['ContentID'];
					$content = $row['Content'];
					echo '<form action="';
					echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?updatePortfolio=' . $_SESSION['id'] . '&tag=' . $tag . '" method="post">
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
						<input class="btn btn-sm btn-primary invoerveld" type="submit" value="Opslaan">
					</p>
				</form>
				';
				}
			} else {
				include 'page/home.php';
			}
		}else{
			if (mysqli_query($dbc, $sql)) {
				$result = mysqli_query($dbc, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					//opmaak voor portfolio bewerken. gebruikt hidden velden om te weten van wie het portfolio is.
					$contentID = $row['ContentID'];
					$content = $row['Content'];
					echo '<form action="';
					echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?updatePortfolio=' . $_SESSION['id'] . '&tag=' . $tag . '" method="post">
					<h1>Edit your portfolio</h1>
					<p>
						<input name="userID" value="' . $_SESSION['id'] . '" type="hidden">
						<input name="contentID" value="' . $contentID . '" type="hidden">
					</p>
					<p class="inputNaam">';
					
					//nog een keer vertaling tags.
					switch ($tag) {
						case "Ervaring":
							$tag = "Experiences";
							break;
						case "Opleidingen":
							$tag = "Studies";
							break;
						case "Interesses":
							$tag = "Interests";
							break;
						case "Overige":
							$tag = "Other";
							break;
						case "Contact":
							$tag = "Contact";
							break;
						default:
							$tag = "About me";
					}
					
					echo $tag;
						
					echo'</p>
							<p>
								<textarea class="invoerveldGroot" name="portfolioContent">' . $content . '</textarea>
							</p>
							<p>
								<input class="btn btn-sm btn-primary invoerveld" type="submit" value="Save">
							</p>
						</form>';
				}
			} else {
				include 'page/home.php';
			}		
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

	function UploadFile($input) {
        // Folder voor uploads
        $dir = "uploads/";

        // Gegevens bestand
		$explode = explode('.',$input["name"]);
		$fileExt = strtolower(pathinfo($input["name"], PATHINFO_EXTENSION));
        $targetFile = $dir . $this->Sanitize(basename($explode[0].'.'.$fileExt));
        $fileType = $input["type"];
        $fileSize = $input["size"];
        $tmpName = $input["tmp_name"];

        $uploadOk = 1;


        // Bestanden die toegestaan zijn
        $AllowedExt = array("jpg", "jpeg", "png", "doc", "docx", "xlsx", "xls", "txt", "pdf");

        $AllowedTypes = array("application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-excel",
            "application/pdf",
            "image/jpeg",
            "image/png"
        );

        // Check if file already exists
        if (file_exists($targetFile)) {
            $targetFile = $dir . $explode[0] . rand(0,99999) . '.'. $fileExt;
        }

        // Check file size 5Mb
        if ($fileSize > 5242880) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($fileType, $AllowedTypes) || !in_array($fileExt, $AllowedExt)) {
            echo "Sorry, only Docx, Doc, xlsx, xls, JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($tmpName, $targetFile)) {
                $dbc = $this->dbc();
                $currentDate = date("Y-m-d");
                if (isset($_POST['omschrijving'])) {
                    $comment = $_POST['omschrijving'];
                } else {
                    $comment = "";
                }
                $sql = 'INSERT INTO `file` (`UserID`, `UploadDate`, `FileName`, `FileType`, `Comment`) VALUES (' . $_SESSION['id'] . ' , "' . $currentDate . '", "' . $targetFile . '", "' . $fileExt . '", "' . $comment . '");';

                mysqli_query($dbc, $sql) or die("Het bestand is toegevoegd");
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }

	// Haal de geuploade bestanden op uit het de database die bij deze gebruiker horen
    function getUploadedFiles($userId) {
        $dbc = $this->dbc();
        $sql = "SELECT * FROM `file` WHERE `UserID` = " . $userId;
        $result = mysqli_query($dbc, $sql) or die("Er is iets mis met de querie");
		if($_SESSION['language'] == 'dutch'){
			//opmaakt file uploading. inclusief engels vertaling.
			if (mysqli_num_rows($result) == 0) {
				echo '<div class="alert alert alert-danger "><a href="#" data-dismiss="alert" aria-label="close"></a>Er zijn geen bestanden aan dit portfolio toegevoegd.</div>';
			}else{
				echo '<table class="table table-condensed table-responsive">';
			
				echo '<thead>'
				. '<tr>'
				. '<th style="width: 18%;">Upload datum:</th>'
				. '<th style="width: 20%;">Bestand:</th>'
				. '<th>Omschrijving:</th>'
				. '<th style="width: 8%;">Type:</th>'
				. '<th style="width: 18px;"></th>';
                                if ($userId == $_SESSION['id']) {
					echo '<th style="width: 18px;"></th>';
				}
                                 echo '</tr>'
            . '</thead>';
                                 while ($document = mysqli_fetch_assoc($result)) {
                $date = strtotime($document['UploadDate']);
                echo '<tr>'
                . '<td> ' . strftime('%d-%m-%Y', $date) . '</td>'
                . '<td> ' . $document['FileName'] . '</td>'
                . '<td> ' . $document['Comment'] . '</td>'
                . '<td> ' . $document['FileType'] . '</td>'
                . '<td><a href="' . $document['FileName']  . '" download><span class="glyphicon glyphicon-download"></span></a></td>';
				if(isset($_SESSION['id'])){
					if ($userId == $_SESSION['id']) {
						echo '<td><a href="?page=fileOverview&user=' . $_SESSION['id'] . '&delete=' . $document['FileID'] . '"><span class="glyphicon glyphicon-trash"></span></a></td>';
					}
				}
                echo '</tr>';
            }
            echo '</table>';
			}
		}else{
			//opmaakt file uploading. inclusief engels vertaling.
			if (mysqli_num_rows($result) == 0) {
				echo '<div class="alert alert alert-danger "><a href="#" data-dismiss="alert" aria-label="close"></a>No files have been uploaded to this portfolio.</div>';
			}else{
				echo '<table class="table table-condensed table-responsive">';
			
				echo '<thead>'
				. '<tr>'
				. '<th style="width: 18%;">Upload date:</th>'
				. '<th style="width: 20%;">File:</th>'
				. '<th>Description:</th>'
				. '<th style="width: 8%;">Type:</th>'
				. '<th style="width: 18px;"></th>';	
                                if(isset($_SESSION['id'])){
				if ($userId == $_SESSION['id']) {
					echo '<th style="width: 18px;"></th>';
				}
                                 echo '</tr>'
            . '</thead>';
                                 while ($document = mysqli_fetch_assoc($result)) {
                $date = strtotime($document['UploadDate']);
                echo '<tr>'
                . '<td> ' . strftime('%d-%m-%Y', $date) . '</td>'
                . '<td> ' . $document['FileName'] . '</td>'
                . '<td> ' . $document['Comment'] . '</td>'
                . '<td> ' . $document['FileType'] . '</td>'
                . '<td><a href="' . $document['FileName']  . '" download><span class="glyphicon glyphicon-download"></span></a></td>';
				if(isset($_SESSION['id'])){
					if ($userId == $_SESSION['id']) {
						echo '<td><a href="?page=fileOverview&user=' . $_SESSION['id'] . '&delete=' . $document['FileID'] . '"><span class="glyphicon glyphicon-trash"></span></a></td>';
					}
				}
                echo '</tr>';
            }
            echo '</table>';
			}
		}
                
                }
        
    }

	//verwijderen geuploade bestanden
    function deleteUpload($file) {
        $dbc = $this->dbc();
        $sql = "DELETE FROM `file` WHERE `file`.`FileID` = $file";
        mysqli_query($dbc, $sql) or die("Er is iets mis met de querie");
    }
	
	//Pak alle users
	function getUsers(){
		$dbc = $this->dbc();
		$sql = "SELECT * FROM user";
		
		$result = mysqli_query($dbc, $sql) or die("Er ging iets fout bij het zoeken van de users");
		
		return $result;
	}

	//Pak alle gegevens van een specifieke gebruiker
	function getUserByID($id){
		$dbc = $this->dbc();
		$sql = "SELECT * FROM user WHERE UserID = ".$id."";
		
		$result = mysqli_query($dbc, $sql) or die("Er ging iets fout bij het zoeken van de users");
		
		return $result;
	}
	
	//Pak alle users die een portfolio gemaakt hebben.
	function getUsersWithPortfolio(){
		$dbc = $this->dbc();
		$sql = "SELECT *
				FROM user, content
				WHERE content.UserID=user.UserID
				GROUP BY user.UserID";
		
		$result = mysqli_query($dbc, $sql) or die("Er ging iets fout bij het zoeken van de users");
		
		return $result;
	}
	
	//zoekfunctie voor users met portfolio
	function searchUsers($input){
		$dbc = $this->dbc();
		$sql = "SELECT DISTINCT c.UserID, u.FirstName as FirstName, u.LastName as LastName, u.Email as Email
				  FROM content c
				  LEFT JOIN user u
				  	ON c.UserID = u.UserID
				 WHERE FirstName LIKE '%$input%'
					OR LastName  LIKE '%$input%'
					OR Email 	 LIKE '%$input%'";
		
		$result = mysqli_query($dbc, $sql) or die("Er ging iets fout bij het zoeken van de users");
		
		return $result;
	}
	
	// Input velden opruimen van code en andere html tekens
	function Sanitize($input){
		
		$input 		= stripslashes($input);
		$input		= mysqli_real_escape_string($this->dbc(), $input);
		$input		= htmlentities($input);
		
		return $input;
	}
	
	//avatar uploaden
    function UploadImage($input){
		$dbc = $this->dbc();
		
		$uploadOk = 1;
		// Folder voor uploads
		$dir = "images/avatars/";
		
		// Gegevens bestand
		$targetFile = $dir . $this->Sanitize(basename($input["name"]));
		$fileType = $input["type"];
		$fileSize = $input["size"];
		$tmpName = $input["tmp_name"];
		$fileExt = strtolower(pathinfo($input["name"], PATHINFO_EXTENSION));

		$uploadOk = 1;

		// Bestanden die toegestaan zijn
		$AllowedExt = array("jpg","jpeg","png");

		$AllowedTypes = array("image/jpeg","image/png");
		
		$check = getimagesize($input["tmp_name"]);
		
		if($check !== false) {
			$uploadOk = 1;
			
			echo "Upload is geslaagd!";
			
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}

		// Check file size 5Mb
		if($fileSize > 5242880){
			echo "Sorry, your file is too large.<br>";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if(!in_array($fileType,$AllowedTypes) || !in_array($fileExt,$AllowedExt)){
			echo "Sorry, only JPG, JPEG & PNG files are allowed.<br>";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.<br>";
		// if everything is ok, try to upload file
		} else {
			//hernoem uploaded plaatje naar random naam zodat er geen dubbels komen.
			$temp = explode(".", $input["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);         
			if (move_uploaded_file($tmpName, $dir . $newfilename)) {
                $_SESSION['Avatar'] = $dir . $newfilename;
				$qry = "UPDATE user SET Avatar = '".$dir . $newfilename."' WHERE UserID = ".$_SESSION['id']."";
				mysqli_query($dbc, $qry);
			} else {
				echo "Sorry, there was an error uploading your file.<br>";
			}
		}
	}

	//Deze functie voegt berichten toe van het gastenboek naar de messages tabel
	function InsertMessage($sourceuser,$targetuser, $postdate, $timestamp, $message){
		$dbc = $this->dbc();
		
		$qry = "INSERT INTO message VALUES (NULL, '$sourceuser', '$targetuser', '$postdate', '$timestamp', '$message')";
		
		mysqli_query($dbc, $qry);
	}
	
	//haal alle berichten op voor het gastenboek
	function getMessages($userid){
		$dbc = $this->dbc();
		
		$qry = "SELECT m.*, u.FirstName AS FirstName, u.LastName AS LastName
				FROM message AS m
				LEFT JOIN user AS u
					ON u.UserID = m.SourceUserID
				WHERE m.TargetUserID = '$userid'";
		
		$result = mysqli_query($dbc, $qry);
		
		if(mysqli_num_rows($result) == 0){
			if($_SESSION["language"] == "dutch"){
				echo '<div class="alert alert alert-danger alert-gastboek"><a href="#" data-dismiss="alert" aria-label="close"></a>Er zijn nog geen berichten op dit profiel geplaatst.</div>';
			}else{
				echo '<div class="alert alert alert-danger alert-gastboek"><a href="#" data-dismiss="alert" aria-label="close"></a>There are no messages on this profile yet.</div>';
			}
		}else{
			//loop door alle berichten en verwerk in de DOM.
			while($row = mysqli_fetch_assoc($result)){
				$name = htmlentities($row["FirstName"] . " " . $row["LastName"]);
				$message = htmlentities($row["Message"]);
				$date = htmlentities($row["PostDate"]);
				$time = htmlentities($row["Timestamp"]);
				$id = htmlentities($row["MessageID"]);
				if($_SESSION['language'] == 'dutch'){
					echo '<div class="alert alert-info message-gastboek">';
						echo '<div class="name_message"><b>'.$name.' schreef:</b><span class="date_message">'.$date.' om '.$time.'&nbsp;&nbsp;';						
						if(isset($_SESSION['id'])){
							if($_SESSION['id'] == $_GET['user']){
								echo '<a href="'.htmlentities($_SERVER["PHP_SELF"]).'?page=profiel&user='.$_GET['user'].'&msgid='.$id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
							}
						}
						echo'</span></div>';
						echo '<div class="message">'.$message.'</div>';
					echo '</div>';
				}else{
					echo '<div class="alert alert-info message-gastboek">';
						echo '<div class="name_message"><b>'.$name.' wrote:</b><span class="date_message">'.$date.' at '.$time.'&nbsp;&nbsp;';
						if(isset($_SESSION['id'])){
							if($_SESSION['id'] == $_GET['user']){
								echo '<a href="'.htmlentities($_SERVER["PHP_SELF"]).'?page=profiel&user='.$_GET['user'].'&msgid='.$id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
							}
						}						
						echo'</span></div>';
						echo '<div class="message">'.$message.'</div>';
					echo '</div>';				
				}
			}
		}
	}
}
?>